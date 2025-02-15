<?php

namespace App\Repository;

use App\Entity\MouvementsStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<MouvementsStock>
 */
class MouvementsStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MouvementsStock::class);
    }

    //    /**
    //     * @return MouvementsStock[] Returns an array of MouvementsStock objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('m.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?MouvementsStock
    //    {
    //        return $this->createQueryBuilder('m')
    //            ->andWhere('m.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
    // src/Repository/MouvementsStockRepository.php

public function findMouvementsWithMateriel(): array
{
    return $this->createQueryBuilder('m')
        ->innerJoin('m.idMateriel', 'mat') // Jointure avec Materiel
        ->addSelect('mat') // Sélectionnez également les données de Materiel
        ->getQuery()
        ->getResult();
}
}
