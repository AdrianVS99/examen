<?php

namespace App\Repository;

use App\Entity\Voto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Voto>
 *
 * @method Voto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Voto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Voto[]    findAll()
 * @method Voto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VotoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voto::class);
    }

//    /**
//     * @return Voto[] Returns an array of Voto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Voto
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
