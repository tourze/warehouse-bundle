<?php

namespace WarehouseBundle\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\Bundle\BundleInterface;
use WarehouseBundle\WarehouseBundle;

class WarehouseBundleTest extends TestCase
{
    public function testBundle_implementsBundleInterface(): void
    {
        $bundle = new WarehouseBundle();
        
        $this->assertInstanceOf(BundleInterface::class, $bundle);
    }
} 