<?php

namespace WarehouseBundle\Tests\Entity;

use Doctrine\Common\Collections\Collection;
use PHPUnit\Framework\TestCase;
use WarehouseBundle\Entity\Warehouse;
use WarehouseBundle\Entity\Zone;

class WarehouseTest extends TestCase
{
    private Warehouse $warehouse;

    protected function setUp(): void
    {
        $this->warehouse = new Warehouse();
    }

    public function testGetId_initialValueIsZero(): void
    {
        $this->assertEquals(0, $this->warehouse->getId());
    }

    public function testSetAndGetCode_validString_returnsCode(): void
    {
        $code = 'WH001';
        $result = $this->warehouse->setCode($code);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertEquals($code, $this->warehouse->getCode());
    }

    public function testSetAndGetName_validString_returnsName(): void
    {
        $name = '主仓库';
        $result = $this->warehouse->setName($name);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertEquals($name, $this->warehouse->getName());
    }

    public function testToString_whenIdIsZero_returnsEmptyString(): void
    {
        $this->assertSame('', (string)$this->warehouse);
    }

    public function testToString_whenIdIsNotZero_returnsFormattedString(): void
    {
        $warehouse = new Warehouse();
        $warehouse->setName('测试仓库');
        $warehouse->setCode('TEST');
        
        // 使用反射设置私有属性id的值，以模拟从数据库获取的对象
        $reflection = new \ReflectionClass($warehouse);
        $property = $reflection->getProperty('id');
        $property->setAccessible(true);
        $property->setValue($warehouse, 1);
        
        $this->assertEquals('测试仓库(TEST)', (string)$warehouse);
    }

    public function testSetAndGetContactName_validString_returnsContactName(): void
    {
        $contactName = '张三';
        $result = $this->warehouse->setContactName($contactName);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertEquals($contactName, $this->warehouse->getContactName());
    }

    public function testSetAndGetContactName_nullValue_returnsNull(): void
    {
        $result = $this->warehouse->setContactName(null);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertNull($this->warehouse->getContactName());
    }

    public function testSetAndGetContactTel_validString_returnsContactTel(): void
    {
        $contactTel = '13800138000';
        $result = $this->warehouse->setContactTel($contactTel);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertEquals($contactTel, $this->warehouse->getContactTel());
    }

    public function testSetAndGetContactTel_nullValue_returnsNull(): void
    {
        $result = $this->warehouse->setContactTel(null);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertNull($this->warehouse->getContactTel());
    }

    public function testGetZones_initialState_returnsEmptyCollection(): void
    {
        $zones = $this->warehouse->getZones();
        
        $this->assertInstanceOf(Collection::class, $zones);
        $this->assertTrue($zones->isEmpty());
    }

    public function testAddZone_newZone_addsZoneToCollection(): void
    {
        $zone = new Zone();
        $result = $this->warehouse->addZone($zone);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertTrue($this->warehouse->getZones()->contains($zone));
        $this->assertSame($this->warehouse, $zone->getWarehouse());
    }

    public function testAddZone_existingZone_doesNotAddZoneAgain(): void
    {
        $zone = new Zone();
        $this->warehouse->addZone($zone);
        $result = $this->warehouse->addZone($zone);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertEquals(1, $this->warehouse->getZones()->count());
    }

    public function testRemoveZone_existingZone_removesZoneFromCollection(): void
    {
        $zone = new Zone();
        $this->warehouse->addZone($zone);
        $result = $this->warehouse->removeZone($zone);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertFalse($this->warehouse->getZones()->contains($zone));
        $this->assertNull($zone->getWarehouse());
    }

    public function testRemoveZone_nonExistingZone_returnsCurrentInstance(): void
    {
        $zone = new Zone();
        $result = $this->warehouse->removeZone($zone);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertFalse($this->warehouse->getZones()->contains($zone));
    }

    public function testRemoveZone_withAnotherWarehouse_doesNotNullifyWarehouseReference(): void
    {
        $zone = new Zone();
        $this->warehouse->addZone($zone);
        
        $anotherWarehouse = new Warehouse();
        $zone->setWarehouse($anotherWarehouse);
        
        $result = $this->warehouse->removeZone($zone);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertFalse($this->warehouse->getZones()->contains($zone));
        $this->assertSame($anotherWarehouse, $zone->getWarehouse());
    }

    public function testSetAndGetCreateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTimeImmutable();
        $this->warehouse->setCreateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->warehouse->getCreateTime());
    }

    public function testSetAndGetUpdateTime_validDateTime_returnsDateTime(): void
    {
        $dateTime = new \DateTimeImmutable();
        $this->warehouse->setUpdateTime($dateTime);
        
        $this->assertEquals($dateTime, $this->warehouse->getUpdateTime());
    }

    public function testSetAndGetCreatedBy_validString_returnsCreatedBy(): void
    {
        $createdBy = 'admin';
        $result = $this->warehouse->setCreatedBy($createdBy);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertEquals($createdBy, $this->warehouse->getCreatedBy());
    }

    public function testSetAndGetUpdatedBy_validString_returnsUpdatedBy(): void
    {
        $updatedBy = 'system';
        $result = $this->warehouse->setUpdatedBy($updatedBy);
        
        $this->assertSame($this->warehouse, $result);
        $this->assertEquals($updatedBy, $this->warehouse->getUpdatedBy());
    }
} 