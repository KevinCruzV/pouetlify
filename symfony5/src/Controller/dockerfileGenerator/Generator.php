<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Yaml\Yaml;

// Load the composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// Create the Symfony application
$app = new Symfony\Component\Console\Application();

        // Generate the Docker Compose file
        if ($choice === 'sql') {
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
        $filename = 'Dockerfile.' . $choice . '.yml';
        file_put_contents($filename, $yaml);

// Output a message to the user
console.log( $filename . 'generated with success');
