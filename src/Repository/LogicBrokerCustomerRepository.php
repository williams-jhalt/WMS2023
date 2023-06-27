<?php

namespace App\Repository;

use App\Entity\LogicBrokerCustomer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LogicBrokerCustomer>
 *
 * @method LogicBrokerCustomer|null find($id, $lockMode = null, $lockVersion = null)
 * @method LogicBrokerCustomer|null findOneBy(array $criteria, array $orderBy = null)
 * @method LogicBrokerCustomer[]    findAll()
 * @method LogicBrokerCustomer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LogicBrokerCustomerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LogicBrokerCustomer::class);
    }

    public function save(LogicBrokerCustomer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(LogicBrokerCustomer $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return LogicBrokerCustomer[] Returns an array of LogicBrokerCustomer objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('l.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?LogicBrokerCustomer
//    {
//        return $this->createQueryBuilder('l')
//            ->andWhere('l.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
