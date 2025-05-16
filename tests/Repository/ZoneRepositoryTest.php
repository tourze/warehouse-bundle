<?php

namespace WarehouseBundle\Tests\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Zone;
use WarehouseBundle\Repository\ZoneRepository;

class ZoneRepositoryTest extends TestCase
{
    private ManagerRegistry $registry;
    private EntityManagerInterface $entityManager;
    private ZoneRepository $repository;

    protected function setUp(): void
    {
        $this->registry = $this->createMock(ManagerRegistry::class);
        $this->entityManager = $this->createMock(EntityManagerInterface::class);
        
        $this->registry->method('getManagerForClass')
            ->with(Zone::class)
            ->willReturn($this->entityManager);
            
        $this->repository = new ZoneRepository($this->registry);
    }

    public function testConstruct_correctlyRegistersEntityClass(): void
    {
        $this->assertInstanceOf(ZoneRepository::class, $this->repository);
    }
} 