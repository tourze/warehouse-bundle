<?php

namespace WarehouseBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use WarehouseBundle\Entity\Shelf;

/**
 * @method Shelf|null find($id, $lockMode = null, $lockVersion = null)
 * @method Shelf|null findOneBy(array $criteria, array $orderBy = null)
 * @method Shelf[] findAll()
 * @method Shelf[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ShelfRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Shelf::class);
    }
}
