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
        $backupPath = '/var/www/html/backup';
        $backupFilename = 'backup_' . date('Y-m-d') . '.tar.gz';
        $fullPath = $backupPath . '/' . $backupFilename;


        if (!file_exists($fullPath)) {
            throw $this->createNotFoundException('Le fichier de sauvegarde n\'existe pas.');
        }

        // Création d'un objet BinaryFileResponse avec le fichier de sauvegarde
        $response = new BinaryFileResponse($fullPath);
        // Définition des headers de la réponse
        $response->headers->set('Content-Type', 'application/gzip');
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $backupFilename,
            iconv('UTF-8', 'ASCII//TRANSLIT', $backupFilename)
        );

        return $response;

    }

}