<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class CalculatriceTest extends TestCase
{
    protected $calculatrice;

    protected function setUp(): void
    {
        $this->calculatrice = new Calculatrice();
    }

    protected function tearDown(): void
    {
        $this->calculatrice = null;
    }

    public function testAddNominal(): void
    {
        $result = $this->calculatrice->add(10, 2);
        $this->assertEquals(
            12,
            $result
        );
    }

    public function testDivByZero()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage('Division par zero');
        $this->calculatrice->div(3, 0);
    }
}