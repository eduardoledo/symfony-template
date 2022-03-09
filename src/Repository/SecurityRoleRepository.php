<?php

namespace App\Repository;

use App\Entity\SecurityRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SecurityRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method SecurityRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method SecurityRole[]    findAll()
 * @method SecurityRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SecurityRoleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SecurityRole::class);
    }

    // /**
    //  * @return SecurityRole[] Returns an array of SecurityRole objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SecurityRole
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
