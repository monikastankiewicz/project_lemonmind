<?php

namespace App\Repository;

use App\Entity\Cargo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cargo>
 *
 * @method Cargo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cargo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cargo[]    findAll()
 * @method Cargo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CargoRepository extends ServiceEntityRepository
{    
    /**
     * @param  mixed $registry
     * @return void
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cargo::class);
    }

    /**
     * @param Cargo $entity
     * @param bool $flush
     * 
     * @return void
     */
    public function save(Cargo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @param Cargo $entity
     * @param bool $flush
     * 
     * @return void
     */
    public function remove(Cargo $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

   /**
    * @return Cargo[] Returns an array of Cargo objects
    */
   public function findByExampleField($value): array
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.exampleField = :val')
           ->setParameter('val', $value)
           ->orderBy('c.id', 'ASC')
           ->setMaxResults(10)
           ->getQuery()
           ->getResult()
       ;
   }

   /**
    * @param mixed $value
    * 
    * @return Cargo|null
    */
   public function findOneBySomeField($value): ?Cargo
   {
       return $this->createQueryBuilder('c')
           ->andWhere('c.exampleField = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
}
