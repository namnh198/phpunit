<?php

namespace Tests;

use App\Mailer;
use PHPUnit\Framework\TestCase;

class MailerTest extends TestCase
{
    // public function testMockMailer()
    // {
    //     // $mailer = new Mailer;

    //     $mockMailer = $this->createMock(Mailer::class);

    //     $mockMailer->method('sendMessage')
    //             ->willReturn(true);

    //     $result = $mockMailer->sendMessage('david@example.com', 'Hello World');

    //     $this->assertEquals(true, $result);
    // }

    public function testSendMessageSuccess()
    {
        $mailer = new Mailer;

        $this->assertTrue($mailer->sendMessage('dave@example.com', 'Hello!'));

    }

    public function testSendMessageReturnTrue()
    {
        $this->assertTrue(Mailer::send('david@example.com', 'Hello World!'));
    }

    public function testSendMessageThrowInvalidIfEmailIsEmpty()
    {
        $mailer = $this->expectException(\InvalidArgumentException::class);

        $this->assertTrue(Mailer::send('', ''));
    }
}
