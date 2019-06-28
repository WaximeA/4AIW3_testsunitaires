<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class BankAccountTest extends TestCase
{
    private $user;
    private $product;
    private $owner;
    private $emailSender;
    private $dbConnexion;
    private $exchange;

    protected function setUp(): void
    {
        $this->user        = new User('Waxime', 'Aveline', 'waxime@aveline.fr', 22);
        $this->owner       = new User('John', 'Doe', 'john@doe.fr', 17);
        $this->product     = new Product('Product name', $this->owner);
        $this->emailSender = $this->createMock(EmailSender::class);
        $this->emailSender->expects($this->any())->method('sendEmail')->will($this->returnValue(true));
        $this->dbConnexion = $this->createMock(DatabaseConnection::class);
        $this->dbConnexion->expects($this->any())->method('saveExchange')->will($this->returnValue(true));
        $this->exchange = new Exchange(
            $this->user,
            $this->product,
            new DateTime('30-05-2020'),
            new DateTime('05-06-2020'),
            $this->emailSender,
            $this->dbConnexion
        );
    }

    protected function tearDown(): void
    {
        $this->user        = null;
        $this->owner       = null;
        $this->product     = null;
        $this->emailSender = null;
        $this->dbConnexion = null;
    }

    public function testEmailSenderMock()
    {
        $emailSenderMock = $this->getMockBuilder(EmailSender::class)->disableOriginalConstructor()->getMock();
        $emailSenderMock->method('sendEmail')->willReturn(true);

        $this->assertEquals(true, $emailSenderMock->sendEmail('waxime@me.fr', 'email content'));
    }

    public function testisValidDateNominal(): void
    {
        $result = $this->exchange->isValidDate();
        $this->assertTrue($result);
    }

    public function testisNotValidDateBecauseOfStartDateInPast(): void
    {
        $this->exchange->setStartDate(new DateTime('01-01-1999'));
        $result = $this->exchange->isValidDate();
        $this->assertFalse($result);
    }

    public function testisNotValidDateBecauseOfInversedDates(): void
    {
        $this->exchange->setStartDate(new DateTime('01-01-2030'));
        $this->exchange->setEndDate(new DateTime('01-01-1999'));
        $result = $this->exchange->isValidDate();
        $this->assertFalse($result);
    }

    public function testIsValidNominal(): void
    {
        $result = $this->exchange->isValid();
        $this->assertTrue($result);
    }

    public function testIsNotValid(): void
    {
        $receiver = $this->createMock(User::class);
        $receiver
            ->expects($this->any())
            ->method('isValid')
            ->will($this->returnValue(false));

        $this->exchange->setReceiver($receiver);

        $result = $this->exchange->isValid();
        $this->assertFalse($result);
    }

    public function testSaveNominal(): void
    {
        $result = $this->exchange->save();
        $this->assertTrue($result);
    }

}