<?php

namespace App\Repository;

use App\Entity\Sindicato;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Sindicato>
 *
 * @method Sindicato|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sindicato|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sindicato[]    findAll()
 * @method Sindicato[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SindicatoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sindicato::class);
    }

//    /**
//     * @return Sindicato[] Returns an array of Sindicato objects
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

//    public function findOneBySomeField($value): ?Sindicato
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
