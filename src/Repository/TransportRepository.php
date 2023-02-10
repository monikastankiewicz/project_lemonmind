<?php

namespace App\Repository;

use App\Entity\Transport;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Transport>
 *
 * @method Transport|null find($id, $lockMode = null, $lockVersion = null)
 * @method Transport|null findOneBy(array $criteria, array $orderBy = null)
 * @method Transport[]    findAll()
 * @method Transport[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TransportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Transport::class);
    }

    /**
     * @param Transport $entity
     * @param bool $flush
     * 
     * @return void
     */
    public function save(Transport $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Transport $entity
     * @param bool $flush
     * 
     * @return void
     */
    public function remove(Transport $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Transport[] Returns an array of Transport objects
    */
   public function findByExampleField($value): array
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

   /**
    * @param mixed $value
    * 
    * @return Transport|null
    */
   public function findOneBySomeField($value): ?Transport
   {
       return $this->createQueryBuilder('t')
           ->andWhere('t.exampleField = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
