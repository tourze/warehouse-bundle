<?php

namespace WarehouseBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use WarehouseBundle\Entity\Warehouse;

/**
 * 账实相符，只能做到这个程度
 * 一般来说，库存的出库都是先进先出，尽可能出掉旧货
 *
 * @see http://www.logclub.com/m/articleInfo/ODAxMQ==
 * @method Warehouse|null find($id, $lockMode = null, $lockVersion = null)
 * @method Warehouse|null findOneBy(array $criteria, array $orderBy = null)
 * @method Warehouse[] findAll()
 * @method Warehouse[] findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WarehouseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Warehouse::class);
    }
}
