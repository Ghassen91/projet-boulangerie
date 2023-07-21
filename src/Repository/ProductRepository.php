<?php

namespace App\Repository;

use App\DTO\ProductSearchCriteria;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
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

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }


    /**
     * Permet de récupérer les 25 dernières recettes
     */
    public function findLatest(): array
    {
        return $this
            ->createQueryBuilder('recette')
            ->setMaxResults(25)
            ->orderBy('recette.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }

    /**
     * Permet de rechercher par critères
     */
    public function findAllByCriteria(ProductSearchCriteria $criteria): array
    {
        //création du query builder paginé
        $qb = $this
            ->createQueryBuilder('product')
            ->setMaxResults($criteria->limit)
            ->setFirstResult($criteria->limit * ($criteria->page - 1))
            ->orderBy("product.{$criteria->orderBy}", $criteria->direction);

        // S'il y a une recherche par nom
        if ($criteria->name) 
        {
            $qb
                ->andWhere("product.name LIKE :name")
                //cela évite les injections SQL
                ->setParameter('name', "%{$criteria->name}%");
        }

        // Je retourne les résultats
        return $qb->getQuery()->getResult();
    }

//    /**
//     * @return Product[] Returns an array of Product objects
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

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}