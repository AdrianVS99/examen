<?php

namespace App\Repository;

use App\Entity\Parametro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Parametro>
 *
 * @method Parametro|null find($id, $lockMode = null, $lockVersion = null)
 * @method Parametro|null findOneBy(array $criteria, array $orderBy = null)
 * @method Parametro[]    findAll()
 * @method Parametro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ParametroRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Parametro::class);
    }

//    /**
//     * @return Parametro[] Returns an array of Parametro objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Parametro
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
