<?php

namespace App\Repository;

use App\Entity\Zamowienie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Zamowienie>
 *
 * @method Zamowienie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Zamowienie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Zamowienie[]    findAll()
 * @method Zamowienie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ZamowienieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Zamowienie::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Zamowienie $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Zamowienie $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function findByNumerAndStatus($numer, $status)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.numer_trackingowy = :numer')
            ->andWhere('z.status = :status')
            ->setParameters([
                'status' =>  $status,
                'numer'=> $numer
                ])
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }

    public function findOneById($value): ?Zamowienie
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    // /**
    //  * @return Zamowienie[] Returns an array of Zamowienie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('z.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Zamowienie
    {
        return $this->createQueryBuilder('z')
            ->andWhere('z.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
