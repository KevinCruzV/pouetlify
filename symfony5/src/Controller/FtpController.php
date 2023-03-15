<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FtpController extends AbstractController
{
    #[Route('/ftp/upload/{fichier1}/{fichier2}', name: 'ftp_upload', methods: 'POST')]
    public function envoiFTP($fichier1, $fichier2): Response
    {
        $chemin_script = '/home/scripts';
        $cmd = sprintf("run-parts %s %s %s", $chemin_script, $fichier1, $fichier2);
        $output = shell_exec(sprintf("%s > /dev/null 2>&1 &", $cmd));

        return new Response("Script FTP en cours d'exécution en arrière-plan.");
    }
}