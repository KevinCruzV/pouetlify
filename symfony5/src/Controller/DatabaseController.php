<?php 

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;
use Doctrine\Persistence\ManagerRegistry;

class DatabaseController extends AbstractController
{

    public ManagerRegistery $managerRegistery;

    public function __construct(ManagerRegistery $managerRegistery)
    {
        $this->managerRegistery = $managerRegistery;
    }

    #[Route('/database', methods: 'GET')]
    public function getDatabaseInfo()
    {
        $connection = $this->managerRegistery->getConnection('sites');
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