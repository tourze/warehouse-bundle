<?php

namespace WarehouseBundle\Tests\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Warehouse;
use WarehouseBundle\Repository\WarehouseRepository;

class WarehouseRepositoryTest extends TestCase
{
    private ManagerRegistry $registry;
    private EntityManagerInterface $entityManager;
    private WarehouseRepository $repository;

    protected function setUp(): void
    {
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        
        $this->registry->method('getManagerForClass')
            ->with(Warehouse::class)
            ->willReturn($this->entityManager);
            
        $this->repository = new WarehouseRepository($this->registry);
    }

    public function testConstruct_correctlyRegistersEntityClass(): void
    {
        $this->assertInstanceOf(WarehouseRepository::class, $this->repository);
    }
} 