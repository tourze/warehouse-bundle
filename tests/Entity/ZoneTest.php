<?php

namespace WarehouseBundle\Tests\Entity;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Shelf;
use WarehouseBundle\Entity\Warehouse;
use WarehouseBundle\Entity\Zone;

class ZoneTest extends TestCase
{
    private Zone $zone;

    protected function setUp(): void
    {
        $this->zone = new Zone();
    }

    public function testGetId_initialValueIsZero(): void
    {
        $this->assertEquals(0, $this->zone->getId());
    }

    public function testSetAndGetWarehouse_validWarehouse_returnsWarehouse(): void
    {
        $warehouse = new Warehouse();
        $result = $this->zone->setWarehouse($warehouse);
        
        $this->assertSame($this->zone, $result);
        $this->assertSame($warehouse, $this->zone->getWarehouse());
    }

    public function testSetAndGetWarehouse_nullValue_returnsNull(): void
    {
        $result = $this->zone->setWarehouse(null);
        
        $this->assertSame($this->zone, $result);
        $this->assertNull($this->zone->getWarehouse());
    }

    public function testSetAndGetTitle_validString_returnsTitle(): void
    {
        $title = 'A区';
        $result = $this->zone->setTitle($title);
        
        $this->assertSame($this->zone, $result);
        $this->assertEquals($title, $this->zone->getTitle());
    }

    public function testSetAndGetAcreage_validString_returnsAcreage(): void
    {
        $acreage = '100.50';
        $result = $this->zone->setAcreage($acreage);
        
        $this->assertSame($this->zone, $result);
        $this->assertEquals($acreage, $this->zone->getAcreage());
    }

    public function testSetAndGetAcreage_nullValue_returnsNull(): void
    {
        $result = $this->zone->setAcreage(null);
        
        $this->assertSame($this->zone, $result);
        $this->assertNull($this->zone->getAcreage());
    }

    public function testSetAndGetType_validString_returnsType(): void
    {
        $type = '普通仓';
        $result = $this->zone->setType($type);
        
        $this->assertSame($this->zone, $result);
        $this->assertEquals($type, $this->zone->getType());
    }

    public function testGetShelves_initialState_returnsEmptyCollection(): void
    {
        $shelves = $this->zone->getShelves();
        
        $this->assertInstanceOf(Collection::class, $shelves);
        $this->assertTrue($shelves->isEmpty());
    }

    public function testAddShelf_newShelf_addsShelfToCollection(): void
    {
        $shelf = new Shelf();
        $result = $this->zone->addShelf($shelf);
        
        $this->assertSame($this->zone, $result);
        $this->assertTrue($this->zone->getShelves()->contains($shelf));
        $this->assertSame($this->zone, $shelf->getZone());
    }

    public function testAddShelf_existingShelf_doesNotAddShelfAgain(): void
    {
        $shelf = new Shelf();
        $this->zone->addShelf($shelf);
        $result = $this->zone->addShelf($shelf);
        
        $this->assertSame($this->zone, $result);
        $this->assertEquals(1, $this->zone->getShelves()->count());
    }

    public function testRemoveShelf_existingShelf_removesShelfFromCollection(): void
    {
        $shelf = new Shelf();
        $this->zone->addShelf($shelf);
        $result = $this->zone->removeShelf($shelf);
        
        $this->assertSame($this->zone, $result);
        $this->assertFalse($this->zone->getShelves()->contains($shelf));
        $this->assertNull($shelf->getZone());
    }

    public function testRemoveShelf_nonExistingShelf_returnsCurrentInstance(): void
    {
        $shelf = new Shelf();
        $result = $this->zone->removeShelf($shelf);
        
        $this->assertSame($this->zone, $result);
        $this->assertFalse($this->zone->getShelves()->contains($shelf));
    }

    public function testRemoveShelf_withAnotherZone_doesNotNullifyZoneReference(): void
    {
        $shelf = new Shelf();
        $this->zone->addShelf($shelf);
        
        $anotherZone = new Zone();
        $shelf->setZone($anotherZone);
        
        $result = $this->zone->removeShelf($shelf);
        
        $this->assertSame($this->zone, $result);
        $this->assertFalse($this->zone->getShelves()->contains($shelf));
        $this->assertSame($anotherZone, $shelf->getZone());
    }

    public function testSetAndGetCreateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTimeImmutable();
        $this->zone->setCreateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->zone->getCreateTime());
    }

    public function testSetAndGetUpdateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTimeImmutable();
        $this->zone->setUpdateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->zone->getUpdateTime());
    }

    public function testSetAndGetCreatedBy_validString_returnsCreatedBy(): void
    {
        $createdBy = 'admin';
        $result = $this->zone->setCreatedBy($createdBy);
        
        $this->assertSame($this->zone, $result);
        $this->assertEquals($createdBy, $this->zone->getCreatedBy());
    }

    public function testSetAndGetUpdatedBy_validString_returnsUpdatedBy(): void
    {
        $updatedBy = 'system';
        $result = $this->zone->setUpdatedBy($updatedBy);
        
        $this->assertSame($this->zone, $result);
        $this->assertEquals($updatedBy, $this->zone->getUpdatedBy());
    }
} 