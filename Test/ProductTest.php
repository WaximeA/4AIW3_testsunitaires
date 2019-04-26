<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    private $owner;

    protected function setUp(): void
    {
        $this->owner = new User('Waxime', 'Aveline', 'waxime@aveline.fr', 22);
    }

    protected function tearDown(): void
    {
        $this->owner = null;
    }

    public function testIsValidNominal(): void
    {
        $product = new Product('Product', $this->owner);
        $result = $product->isValid();
        $this->assertTrue($result);
    }

    public function testProductOwnerIsNotValid()
    {
        $this->expectException(Exception::class);
        $this->owner->setAge(9);

        $product = new Product('Product', $this->owner);

        $result = $product->isValid();
        $this->assertFalse($result);
    }


}