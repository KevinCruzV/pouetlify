<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;
use ZipArchive;

class DownloadBackupController extends AbstractController
{
    #[Route('/api/backup/download', name: 'backup_download', methods: 'GET')]
    public function downloadBackupAction(): BinaryFileResponse
    {
        $date  = '';
        $file = '/var/www/html/backup/site/backup_'.$date.'.tar.gz';

        if (!file_exists($file)) {
            throw $this->createNotFoundException('The file does not exist');
        }

        $response = new BinaryFileResponse($file);
        $response->headers->set('Content-Type', 'application/gzip');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, 'backup.tar.gz');

        return $response;

    }
}