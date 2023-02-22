<?php

namespace App\Repository;

use App\Entity\ImportOrderDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ImportOrderDetail>
 *
 * @method ImportOrderDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImportOrderDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImportOrderDetail[]    findAll()
 * @method ImportOrderDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImportOrderDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ImportOrderDetail::class);
    }

    public function add(ImportOrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ImportOrderDetail $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return ImportOrderDetail[] Returns an array of ImportOrderDetail objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ImportOrderDetail
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
