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
        // Chemin vers le dossier de sauvegarde
        $backupDir = '/chemin/vers/le/dossier/de/sauvegarde';

        // Chemin vers le fichier zip de sauvegarde
        $zipPath = '/chemin/vers/le/fichier/zip/backup.zip';

        // Création d'un objet ZipArchive
        $zip = new ZipArchive();

        // Ouverture du fichier zip en écriture
        $zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Ajout des fichiers du dossier de sauvegarde au fichier zip
        $fs = new Filesystem();
        $fs->mirror($backupDir, 'zip://' . $zipPath . '#backup');

        // Fermeture du fichier zip
        $zip->close();

        // Création d'une réponse HTTP pour le fichier zip
        $response = new BinaryFileResponse($zipPath);

        // Définition du nom de fichier et de l'en-tête de type de contenu
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            'backup.zip'
        );
        $response->headers->set('Content-Type', 'application/zip');

        // Envoi de la réponse HTTP
        return $response;
    }
}