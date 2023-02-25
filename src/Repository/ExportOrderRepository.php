<?php

namespace App\Repository;

use App\Entity\ExportOrder;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExportOrder>
 *
 * @method ExportOrder|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExportOrder|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExportOrder[]    findAll()
 * @method ExportOrder[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExportOrderRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExportOrder::class);
    }

    public function add(ExportOrder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(ExportOrder $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function totalPrice(): array
   {
        $en= $this->getEntityManager()->getConnection();
        $sql='
        SELECT e.id,e.ex_user_id,e.time,SUM((p.price_export*edetail.ex_quantity)) as Total_Price
FROM `export_order` e, `export_order_detail` edetail, `product` p 
WHERE e.id=edetail.exorder_id AND edetail.expro_id=p.id
GROUP BY edetail.exorder_id
        ';
    $stmt=$en->prepare($sql);
    $re=$stmt->executeQuery();
       return $re->fetchAllAssociative();
   }

//    /**
//     * @return ExportOrder[] Returns an array of ExportOrder objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ExportOrder
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
