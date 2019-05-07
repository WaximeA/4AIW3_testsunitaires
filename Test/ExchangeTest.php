<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ExchangeTest extends TestCase
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

//    public function testdbConnexionSaveNominal(): void
//    {
//        $receiver = $this->createMock(Exchange::class, [$this->user,
//                null,
//                new DateTime('30-05-2020'),
//                new DateTime('05-06-2020'),
//                $this->emailSender,
//                $this->dbConnexion]);
//
//
//        $receiver->expects($this->once())
//            ->method('saveUser');
//        $receiver->expects($this->once())
//            ->method('saveProduct');
//        $receiver->expects($this->once())
//            ->method('saveExchange');
//
//        $result = $receiver->save();
//        $this->assertTrue($result);
//
//        // Create a stub for the SomeClass class.
//        $stub = $this->getMockBuilder($originalClassName)
//            ->disableOriginalConstructor()
//            ->disableOriginalClone()
//            ->disableArgumentCloning()
//            ->disallowMockingUnknownTypes()
//            ->getMock();
//
//        // Configure the stub.
//        $stub->method('doSomething')
//            ->willReturn('foo');
//
//        // Calling $stub->doSomething() will now return
//        // 'foo'.
//        $this->assertEquals('foo', $stub->doSomething());
//    }

//    public function testSave(): void
//    {
//        //        $setReciever = $this->createMock(Exchange::class);
//        //        $setReciever
//        //            ->expects($this->any())
//        //            ->method('setReceiver')
//        //            ->will($this->returnValue(User::class));
//
//        $mock = $this
//            ->getMockBuilder(Exchange::class, [], [$this->user,
//                null,
//                new DateTime('30-05-2020'),
//                new DateTime('05-06-2020'),
//                $this->emailSender,
//                $this->dbConnexion])
//            ->disableOriginalConstructor()
//            ->setMethods(['saveUser', 'saveProduct', 'saveExchange'])
//            ->getMock();
//
//        $mock->expects($this->once())
//            ->method('saveUser');
//        $mock->expects($this->once())
//            ->method('saveProduct');
//        $mock->expects($this->once())
//            ->method('saveExchange');
//
////        $mock->method('save')->willReturn(true);
//
//        $result = $mock->save();
//
//
////        $this->exchange->setReceiver(null);
////
////        $result = $this->exchange->save();
//        $this->assertTrue($result);
//    }

    //    public function testSaveFailBecauseOfProduct(): void
    //    {
    //        $this->exchange = $this->createMock(Exchange::class);
    //        $this->exchange
    //            ->expects($this->any())
    //            ->method('setReceiver')
    //            ->will($this->returnValue(null));
    //
    //        $result  = $this->exchange->save();
    //        $this->assertFalse($result);
    //    }

    //    public function testIsValidSendEmail() :void
    //    {
    //       $this->user->setAge(14);
    //
    //        $setReciever = $this->createMock(Exchange::class);
    //        $setReciever
    //            ->expects($this->any())
    //            ->method('setReceiver')
    //            ->will($this->returnValue(User::class));
    //
    ////        $this->exchange->setReceiver($this->user);
    //
    //
    //        $result = $setReciever;
    //        $this->assertInstanceOf(User::class, $result);
    //    }
    //    // test if user is minor AND under 13 (impossible)

    //    public function testIDK() :void
    //    {
    //        //        $emailSender = $this->createMock(EmailSender::class);
    //        //        $emailSender
    //        //            ->expects($this->any())
    //        //            ->method('sendEmail')
    //        //            ->will($this->returnValue(EmailSender::class));
    //
    //        $this->user->setAge(1);
    //
    //        $result = $this->exchange->setReceiver($this->user);
    //        $this->assertInstanceOf(EmailSender::class, $result);
    //    }
    // test if minor alors envoi de mail
}