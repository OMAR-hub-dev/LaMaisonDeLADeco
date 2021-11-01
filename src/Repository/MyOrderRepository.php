<?php

namespace App\Repository;

use App\Entity\MyOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MyOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method MyOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method MyOrder[]    findAll()
 * @method MyOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MyOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MyOrder::class);
    }

    // /**
    //  * @return MyOrder[] Returns an array of MyOrder objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MyOrder
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
