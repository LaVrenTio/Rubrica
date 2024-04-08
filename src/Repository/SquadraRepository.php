<?php

namespace App\Repository;

use App\Entity\Squadra;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Squadra>
 *
 * @method Squadra|null find($id, $lockMode = null, $lockVersion = null)
 * @method Squadra|null findOneBy(array $criteria, array $orderBy = null)
 * @method Squadra[]    findAll()
 * @method Squadra[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SquadraRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Squadra::class);
    }

//    /**
//     * @return Squadra[] Returns an array of Squadra objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Squadra
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
