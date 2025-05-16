<?php

namespace WarehouseBundle\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use WarehouseBundle\DependencyInjection\WarehouseExtension;
use WarehouseBundle\Repository\LocationRepository;
use WarehouseBundle\Repository\ShelfRepository;
use WarehouseBundle\Repository\WarehouseRepository;
use WarehouseBundle\Repository\ZoneRepository;

class WarehouseExtensionTest extends TestCase
{
    private WarehouseExtension $extension;
    private ContainerBuilder $container;

    protected function setUp(): void
    {
        $this->extension = new WarehouseExtension();
        $this->container = new ContainerBuilder();
    }

    public function testLoad_registersRepositoryServices(): void
    {
        $this->extension->load([], $this->container);
        
        // 检查服务定义是否存在
        $this->assertTrue($this->container->hasDefinition(WarehouseRepository::class) || $this->container->hasAlias(WarehouseRepository::class));
        $this->assertTrue($this->container->hasDefinition(ZoneRepository::class) || $this->container->hasAlias(ZoneRepository::class));
        $this->assertTrue($this->container->hasDefinition(ShelfRepository::class) || $this->container->hasAlias(ShelfRepository::class));
        $this->assertTrue($this->container->hasDefinition(LocationRepository::class) || $this->container->hasAlias(LocationRepository::class));
    }

    public function testLoad_setsDefaultsConfiguration(): void
    {
        $this->extension->load([], $this->container);
        
        // 检查是否有针对这些仓库的服务定义, 并且这些定义设置了autowire和autoconfigure
        $definitions = $this->container->getDefinitions();
        $hasAutoWireAndConfigure = false;
        
        foreach ($definitions as $id => $definition) {
            if (strpos($id, 'WarehouseBundle\\Repository\\') === 0) {
                $this->assertTrue($definition->isAutowired(), "Service $id should be autowired");
                $this->assertTrue($definition->isAutoconfigured(), "Service $id should be autoconfigured");
                $hasAutoWireAndConfigure = true;
            }
        }
        
        $this->assertTrue($hasAutoWireAndConfigure, 'At least one repository service should exist with autowire and autoconfigure');
    }
} 