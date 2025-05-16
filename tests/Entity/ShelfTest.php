<?php

namespace WarehouseBundle\Tests\Entity;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Location;
use WarehouseBundle\Entity\Shelf;
use WarehouseBundle\Entity\Zone;

class ShelfTest extends TestCase
{
    private Shelf $shelf;

    protected function setUp(): void
    {
        $this->shelf = new Shelf();
    }

    public function testGetId_initialValueIsZero(): void
    {
        $this->assertEquals(0, $this->shelf->getId());
    }

    public function testSetAndGetZone_validZone_returnsZone(): void
    {
        $zone = new Zone();
        $result = $this->shelf->setZone($zone);
        
        $this->assertSame($this->shelf, $result);
        $this->assertSame($zone, $this->shelf->getZone());
    }

    public function testSetAndGetZone_nullValue_returnsNull(): void
    {
        $result = $this->shelf->setZone(null);
        
        $this->assertSame($this->shelf, $result);
        $this->assertNull($this->shelf->getZone());
    }

    public function testSetAndGetTitle_validString_returnsTitle(): void
    {
        $title = 'A货架';
        $result = $this->shelf->setTitle($title);
        
        $this->assertSame($this->shelf, $result);
        $this->assertEquals($title, $this->shelf->getTitle());
    }

    public function testGetLocations_initialState_returnsEmptyCollection(): void
    {
        $locations = $this->shelf->getLocations();
        
        $this->assertInstanceOf(Collection::class, $locations);
        $this->assertTrue($locations->isEmpty());
    }

    public function testAddLocation_newLocation_addsLocationToCollection(): void
    {
        $location = new Location();
        $result = $this->shelf->addLocation($location);
        
        $this->assertSame($this->shelf, $result);
        $this->assertTrue($this->shelf->getLocations()->contains($location));
        $this->assertSame($this->shelf, $location->getShelf());
    }

    public function testAddLocation_existingLocation_doesNotAddLocationAgain(): void
    {
        $location = new Location();
        $this->shelf->addLocation($location);
        $result = $this->shelf->addLocation($location);
        
        $this->assertSame($this->shelf, $result);
        $this->assertEquals(1, $this->shelf->getLocations()->count());
    }

    public function testRemoveLocation_existingLocation_removesLocationFromCollection(): void
    {
        $location = new Location();
        $this->shelf->addLocation($location);
        $result = $this->shelf->removeLocation($location);
        
        $this->assertSame($this->shelf, $result);
        $this->assertFalse($this->shelf->getLocations()->contains($location));
        $this->assertNull($location->getShelf());
    }

    public function testRemoveLocation_nonExistingLocation_returnsCurrentInstance(): void
    {
        $location = new Location();
        $result = $this->shelf->removeLocation($location);
        
        $this->assertSame($this->shelf, $result);
        $this->assertFalse($this->shelf->getLocations()->contains($location));
    }

    public function testRemoveLocation_withAnotherShelf_doesNotNullifyShelfReference(): void
    {
        $location = new Location();
        $this->shelf->addLocation($location);
        
        $anotherShelf = new Shelf();
        $location->setShelf($anotherShelf);
        
        $result = $this->shelf->removeLocation($location);
        
        $this->assertSame($this->shelf, $result);
        $this->assertFalse($this->shelf->getLocations()->contains($location));
        $this->assertSame($anotherShelf, $location->getShelf());
    }

    public function testSetAndGetCreateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTime();
        $this->shelf->setCreateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->shelf->getCreateTime());
    }

    public function testSetAndGetUpdateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTime();
        $this->shelf->setUpdateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->shelf->getUpdateTime());
    }

    public function testSetAndGetCreatedBy_validString_returnsCreatedBy(): void
    {
        $createdBy = 'admin';
        $result = $this->shelf->setCreatedBy($createdBy);
        
        $this->assertSame($this->shelf, $result);
        $this->assertEquals($createdBy, $this->shelf->getCreatedBy());
    }

    public function testSetAndGetUpdatedBy_validString_returnsUpdatedBy(): void
    {
        $updatedBy = 'system';
        $result = $this->shelf->setUpdatedBy($updatedBy);
        
        $this->assertSame($this->shelf, $result);
        $this->assertEquals($updatedBy, $this->shelf->getUpdatedBy());
    }
} 