<?php

namespace App\Repository;

use App\Entity\TimeCapsule;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TimeCapsule|null find($id, $lockMode = null, $lockVersion = null)
 * @method TimeCapsule|null findOneBy(array $criteria, array $orderBy = null)
 * @method TimeCapsule[]    findAll()
 * @method TimeCapsule[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TimeCapsuleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TimeCapsule::class);
    }

    public function findRelatedToUser ($user, $order)
    {
        return $this->createQueryBuilder('t')
            ->leftJoin('t.contributors', 'u')
            ->orWhere('u.id = :user_id')
            ->setParameter('user_id', $user->getId())
            ->orWhere('t.owner = :user')
            ->setParameter('user', $user)
            ->orderBy(sprintf('t.%s', $order))
            ->getQuery()
            ->getResult();
    }

    public function findByLink($link)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.inviteLink = :link')
            ->setParameter('link', $link)
            ->getQuery()
            ->getOneOrNullResult();
    }

//     * @return TimeCapsule[] Returns an array of TimeCapsule objects
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
    public function findOneBySomeField($value): ?TimeCapsule
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
