<?php

namespace App\Controller\DockerfileGenerator;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\JsonResponse;

class GeneratorController extends AbstractController
{
    #[Route('/api/generator', name: 'app_generator', methods: 'POST')]
    public function index(Request $request)
    {
        if ($request->isMethod('POST')) {
            $data = json_decode($request->getContent(), true);

            // Récupérer les données soumises dans le formulaire
            $option = $data['option'];

            // Faites ici ce que vous souhaitez faire avec les données soumises
                // Load the composer autoloader
                // require_once __DIR__ . '/vendor/autoload.php';

            $app = new Symfony\Component\Console\Application();

            // Generate the Docker Compose file
            if ($option === 'mysql') {
                $yaml = Yaml::dump([
                    'version' => '3',
                    'services' => [
                        'db' => [
                            'image' => 'mysql:latest',
                            'environment' => [
                                'MYSQL_ROOT_PASSWORD' => 'password',
                                'MYSQL_DATABASE' => 'sites',
                            ],
                        ],
                    ],
                ]);
            } else {
                $yaml = Yaml::dump([
                    'version' => '3',
                    'services' => [
                        'ftp' => [
                            'image' => 'fauria/vsftpd:latest',
                            'ports' => ['20:20', '21:21'],
                            'volumes' => ['./ftp:/home/vsftpd'],
                            'environment' => [
                                'FTP_USER_NAME' => 'user',
                                'FTP_USER_PASS' => 'password',
                            ],
                        ],
                    ],
                ]);
            }

            // Save the Docker Compose file to the host's storage
            $filename = 'Dockerfile.' . $option . '.yml';
            file_put_contents($filename, $yaml);



            // Renvoyer une réponse JSON
            return new JsonResponse(['success' => true]);
        }

    }
}
