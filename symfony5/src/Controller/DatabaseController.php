<?php 

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;

class DatabaseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/database', methods: 'GET')]
    public function GetDatabaseInfo(Connection $connection): Response
    {
        $query = $connection->fetchAllAssociative('SHOW TABLE STATUS');
        $statement = $connection->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();

        $size = 0;
        foreach ($result as $row) {
            $size += $row['Data_length'] + $row['Index_length'];
        }

        $size = round($size / 1024 / 1024, 2) . ' MB';

        return $this->json(['size' => $size]);
    }
}