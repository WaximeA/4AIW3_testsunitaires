<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    private $user;

    protected function setUp(): void
    {
        $this->user = new User('Waxime', 'Aveline', 'waxime@aveline.fr', 22);
    }

    protected function tearDown(): void
    {
        $this->user = null;
    }

    public function testIsValidNominal(): void
    {
        $result = $this->user->isValid();
        $this->assertTrue($result);
    }

    public function testIsNotValidBecauseEmailFormat()
    {
        $this->expectException(Exception::class);
        $this->user->setEmail('wrong@email');
    }

    public function testIsNotValidBecauseMissingName ()
    {
        $this->expectException(Exception::class);
        $this->user->setFirstName('');
    }

    public function testIsNotValidBecauseUnderAllowedAge ()
    {
        $this->expectException(Exception::class);
        $this->user->setAge(2);
    }
}