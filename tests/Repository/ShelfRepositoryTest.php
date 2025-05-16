<?php

namespace WarehouseBundle\Tests\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Shelf;
use WarehouseBundle\Repository\ShelfRepository;

class ShelfRepositoryTest extends TestCase
{
    private ManagerRegistry $registry;
    private EntityManagerInterface $entityManager;
    private ShelfRepository $repository;

    protected function setUp(): void
    {
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        
        $this->registry->method('getManagerForClass')
            ->with(Shelf::class)
            ->willReturn($this->entityManager);
            
        $this->repository = new ShelfRepository($this->registry);
    }

    public function testConstruct_correctlyRegistersEntityClass(): void
    {
        $this->assertInstanceOf(ShelfRepository::class, $this->repository);
    }
} 