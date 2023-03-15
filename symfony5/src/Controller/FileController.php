<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use App\Service\UploadHelper;
use App\Form\FileUploadType;

class FileController extends AbstractController
{
    #[Route('/file', name: 'app_file')]
    public function index(Request $request, UploadHelper $helper)
    {
        $form = $this->createForm(FileUploadType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) 
        {
            $uploadFile = $form['uploadFile']->getData();
            $file = $helper->uploadFile($uploadFile);

            if (null !== $file)
            {
              $directory = $helper->getTargetDirectory();
              $fullPath = $directory . '/' . $file;
            }
      }

        return $this->render('files/upload.html.twig', [
            'form' => $form->createView(),
          ]);
    }
}
