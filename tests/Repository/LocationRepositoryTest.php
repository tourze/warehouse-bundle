<?php

namespace WarehouseBundle\Tests\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Location;
use WarehouseBundle\Repository\LocationRepository;

class LocationRepositoryTest extends TestCase
{
    private ManagerRegistry $registry;
    private EntityManagerInterface $entityManager;
    private LocationRepository $repository;

    protected function setUp(): void
    {
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        
        $this->registry->method('getManagerForClass')
            ->with(Location::class)
            ->willReturn($this->entityManager);
            
        $this->repository = new LocationRepository($this->registry);
    }

    public function testConstruct_correctlyRegistersEntityClass(): void
    {
        $this->assertInstanceOf(LocationRepository::class, $this->repository);
    }
} 