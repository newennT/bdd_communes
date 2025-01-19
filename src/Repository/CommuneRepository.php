<?php

namespace App\Repository;

use App\Entity\Commune;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Commune>
 */
class CommuneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Commune::class);
    }

    public function findCommunesByName($query)
    {

        
        return $this->createQueryBuilder('c')
            ->andWhere('(c.nom_francais LIKE :query) OR (c.nom_breton LIKE :query) OR (c.nom_gallo LIKE :query) OR (c.code LIKE :query)')
            ->setParameter('query', '%' . $query . '%')
            ->orderBy('c.code', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        
    }

    //    /**
    //     * @return Commune[] Returns an array of Commune objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Commune
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
