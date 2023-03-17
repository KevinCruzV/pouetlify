<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\UploadHelper;
use App\Form\FileUploadType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileController extends AbstractController
{
    #[Route('/file', name: 'app_file', methods: 'POST')]
    public function index(Request $request, UploadHelper $helper): \Symfony\Component\HttpFoundation\Response
    {
      //  $form = $this->createForm(FileUploadType::class);
        //$form->handleRequest($request);

        //if ($form->isSubmitted() && $form->isValid())
        //{
            $uploadFile = $_POST['file']->getData();
            $file = $helper->uploadFile($uploadFile);

            if (null !== $file)
            {
              $directory = $helper->getTargetDirectory();
              $fullPath = $directory . '/' . $file;

              $chemin_script = '/home/scripts';
              $cmd = sprintf("run-parts %s %s", $chemin_script, $file);
              $output = shell_exec(sprintf("%s > /dev/null 2>&1 &", $cmd));

              return new Response("Script FTP en cours d'exécution en arrière-plan.");

            }
     // }

    }
}
