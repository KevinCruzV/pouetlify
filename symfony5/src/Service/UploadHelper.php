<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Gedmo\Sluggable\Util\Urlizer;
use League\Flysystem\FilesystemOperator;

class UploadHelper
{
    private FilesystemOperator $defaultStorage;

    public function __construct(string $publicPath, FilesystemOperator $defaultStorage)
    {
        $this->defaultStorage = $defaultStorage;
    }

    public function uploadFile(UploadedFile $file): string
    {
        $originalfileName = $file->getClientOriginalName();
        $basefileName = pathinfo($originalfileName, PATHINFO_FILENAME);
        $fileName = Urlizer::urlize($basefileName . '-' . uniqid() . '.' . $file->guessExtension());
        
        $stream = fopen($file->getPathName(), 'r');
        $this->defaultStorage->writeStream(
            '/' . $fileName,
            $stream
        );

        if (is_resource($stream)) {
            fclose($stream);
        }

        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->defaultStorage;
    }

    public function readStream(string $path)
    {
        return $this->defaultStorage->readStream($path);
    }
}