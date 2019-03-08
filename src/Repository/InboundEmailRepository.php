<?php

namespace App\Repository;

use App\Entity\InboundEmail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method InboundEmail|null find($id, $lockMode = null, $lockVersion = null)
 * @method InboundEmail|null findOneBy(array $criteria, array $orderBy = null)
 * @method InboundEmail[]    findAll()
 * @method InboundEmail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InboundEmailRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, InboundEmail::class);
    }

    // /**
    //  * @return InboundEmail[] Returns an array of InboundEmail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InboundEmail
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
