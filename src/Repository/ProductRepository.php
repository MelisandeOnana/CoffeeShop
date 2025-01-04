<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findByFilters(array $filters, int $limit, int $offset)
    {
        $qb = $this->createQueryBuilder('p');

        if (!empty($filters['brand'])) {
            $qb->andWhere('p.brand = :brand')
               ->setParameter('brand', $filters['brand']);
        }

        if (!empty($filters['category'])) {
            $qb->andWhere('p.category = :category')
               ->setParameter('category', $filters['category']);
        }

        if (!empty($filters['price_min'])) {
            $qb->andWhere('p.price >= :price_min')
               ->setParameter('price_min', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $qb->andWhere('p.price <= :price_max')
               ->setParameter('price_max', $filters['price_max']);
        }

        return $qb->setFirstResult($offset)
                  ->setMaxResults($limit)
                  ->getQuery()
                  ->getResult();
    }

    public function countByFilters(array $filters): int
    {
        $qb = $this->createQueryBuilder('p')
                   ->select('COUNT(p.id)');

        if (!empty($filters['brand'])) {
            $qb->andWhere('p.brand = :brand')
               ->setParameter('brand', $filters['brand']);
        }

        if (!empty($filters['category'])) {
            $qb->andWhere('p.category = :category')
               ->setParameter('category', $filters['category']);
        }

        if (!empty($filters['price_min'])) {
            $qb->andWhere('p.price >= :price_min')
               ->setParameter('price_min', $filters['price_min']);
        }

        if (!empty($filters['price_max'])) {
            $qb->andWhere('p.price <= :price_max')
               ->setParameter('price_max', $filters['price_max']);
        }

        return (int) $qb->getQuery()->getSingleScalarResult();
    }
}