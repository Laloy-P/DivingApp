<?php

namespace App\Repository;

use App\Entity\Dive;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Dive|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dive|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dive[]    findAll()
 * @method Dive[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DiveRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Dive::class);
    }

    /**
     * @return Dive[]
     */
    public function findAllTechnicalDives() : array
    {
        return $this->createQueryBuilder('d')
            ->where('d.dive_type = 0')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Dive[]
     */
    public function findAllExplorationDives() : array
    {
        return $this->createQueryBuilder('d')
            ->where('d.dive_type = 1')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return Dive[]
     */
    public function findLatest() : array
    {
        return $this->createQueryBuilder('d')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Dive[] Returns an array of Dive objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Dive
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
