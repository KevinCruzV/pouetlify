<?php 

use Doctrine\ORM\EntityManagerInterface;

class DatabaseController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/database', methods: 'GET')]
    public function getDatabaseInfo()
    {
        $connection = $this->entityManager->getConnection();
        $query = "SHOW TABLE STATUS";
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