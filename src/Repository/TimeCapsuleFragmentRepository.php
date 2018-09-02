<?php

namespace App\Repository;

use App\Entity\TimeCapsuleFragment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TimeCapsuleFragment|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeCapsuleFragment|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeCapsuleFragment[]    findAll()
 * @method TimeCapsuleFragment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeCapsuleFragmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TimeCapsuleFragment::class);
    }

//    /**
//     * @return TimeCapsuleFragment[] Returns an array of TimeCapsuleFragment objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TimeCapsuleFragment
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
