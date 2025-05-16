<?php

namespace WarehouseBundle\Tests\Entity;

use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Location;
use WarehouseBundle\Entity\Shelf;

class LocationTest extends TestCase
{
    private Location $location;

    protected function setUp(): void
    {
        $this->location = new Location();
    }

    public function testGetId_initialValueIsZero(): void
    {
        $this->assertEquals(0, $this->location->getId());
    }

    public function testSetAndGetShelf_validShelf_returnsShelf(): void
    {
        $shelf = new Shelf();
        $result = $this->location->setShelf($shelf);
        
        $this->assertSame($this->location, $result);
        $this->assertSame($shelf, $this->location->getShelf());
    }

    public function testSetAndGetShelf_nullValue_returnsNull(): void
    {
        $result = $this->location->setShelf(null);
        
        $this->assertSame($this->location, $result);
        $this->assertNull($this->location->getShelf());
    }

    public function testSetAndGetTitle_validString_returnsTitle(): void
    {
        $title = 'A01';
        $result = $this->location->setTitle($title);
        
        $this->assertSame($this->location, $result);
        $this->assertEquals($title, $this->location->getTitle());
    }

    public function testSetAndGetTitle_nullValue_returnsNull(): void
    {
        $result = $this->location->setTitle(null);
        
        $this->assertSame($this->location, $result);
        $this->assertNull($this->location->getTitle());
    }

    public function testSetAndGetCreateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTime();
        $this->location->setCreateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->location->getCreateTime());
    }

    public function testSetAndGetUpdateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTime();
        $this->location->setUpdateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->location->getUpdateTime());
    }

    public function testSetAndGetCreatedBy_validString_returnsCreatedBy(): void
    {
        $createdBy = 'admin';
        $result = $this->location->setCreatedBy($createdBy);
        
        $this->assertSame($this->location, $result);
        $this->assertEquals($createdBy, $this->location->getCreatedBy());
    }

    public function testSetAndGetUpdatedBy_validString_returnsUpdatedBy(): void
    {
        $updatedBy = 'system';
        $result = $this->location->setUpdatedBy($updatedBy);
        
        $this->assertSame($this->location, $result);
        $this->assertEquals($updatedBy, $this->location->getUpdatedBy());
    }
} 