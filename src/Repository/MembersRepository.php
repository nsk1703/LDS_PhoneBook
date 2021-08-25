<?php

namespace App\Repository;

use App\Entity\Members;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Members|null find($id, $lockMode = null, $lockVersion = null)
 * @method Members|null findOneBy(array $criteria, array $orderBy = null)
 * @method Members[]    findAll()
 * @method Members[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MembersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Members::class);
    }

    /**
     * @return Members[] by Zone
    */

    public function byZone($zone)
    {
        return $this->createQueryBuilder('m')
            ->where('m.zones = :zone')
            ->setParameter('zone', $zone)
            ->orderBy('m.zones', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

//    public function totalMemberByZone($zone)
//    {
//        return $this->createQueryBuilder('m')
//            ->where('m.zones = :zone')
//            ->setParameter('zone', $zone)
//            ->orderBy('m.zones', 'ASC')
//            ->getQuery()
//            ->getResult()
//            ;
//    }


    /*
    public function findOneBySomeField($value): ?Members
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
