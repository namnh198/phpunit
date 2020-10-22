<?php

namespace Tests;

use App\User;
use App\Mailer;
use Mockery;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    public function tearDown() : void
    {
        Mockery::close();
    }
    /**
     * @dataProvider fullNameProvider
     */
    public function testReturnFullName($firstName, $lastName, $expectFullName)
    {
        $user = new User('dave@example.com');

        $user->firstName = $firstName;
        $user->lastName = $lastName;

        $this->assertEquals($expectFullName, $user->getFullName());
    }

    public function testNotificationIsSent()
    {
        $user = new User('dave@example.com');

        $mockMailer = $this->createMock(Mailer::class);

        $mockMailer->expects($this->once())
            ->method('sendMessage')
            ->with($this->equalTo('dave@example.com'), $this->equalTo('Hello'))
            ->willReturn(true);

        $user->setMailer($mockMailer);



        $this->assertTrue($user->notify('Hello'));
    }

    public function testCanNotSentNotifyWithNoEmail()
    {
        $user = new User;

        // $mockMailer = $this->createMock(Mailer::class);
        // $mockMailer->method('sendMessage')
        //     ->will($this->throwException(new \Exception("Email is Required")));

        $mockMailer = $this->getMockBuilder(Mailer::class)
            ->setMethods(null)
            ->getMock();

        $this->expectException(\Exception::class);

        $user->setMailer($mockMailer);

        $user->notify('Hello');
    }

    public function testSendNotifyReturnsTrue()
    {
        $user = new User('dave@gmail.com');

        // $mockMailer = $this->createMock(Mailer::class);

        $user->setMailerCallable([Mailer::class, 'send']);

        $this->assertTrue($user->sendNotify('Hello'));
    }

    /**
     * @runInSeparateProcess
     * @preserveGlobalState disabled
     */
    public function testSendNotifyWithMockery()
    {
        $user = new User('dave@example.com');

        $mock = Mockery::mock('alias:App\\Mailer');

        $mock->shouldReceive('send')
            ->once()
            ->with($user->email, 'Hello')
            ->andReturnTrue();

        $this->assertTrue($user->sendNotifyMockery('Hello'));
    }

    public function fullNameProvider()
    {
        return [
            ['Nam', 'Hoai', 'Nam Hoai'],
            ['', '', ''],
            ['Nam', '', 'Nam'],
            ['', 'Hoai', 'Hoai'],
        ];
    }
}
