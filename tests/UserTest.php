<?php

use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
    protected $user;

    protected function setUp(): void 
    {
        $this->user = new User;
    }

    public function testReturnsFullName()
    {
        $this->user->first_name = "Teresa";
        $this->user->surname = "Green";
        
        $this->assertEquals('Teresa Green', $this->user->getFullName());
        
    }

    public function testFullNameIsEmptyByDefault() 
    {
        $this->assertEquals('', $this->user->getFullName());
    }

    public function testNotificationIsSent() 
    {
        $mock_mailer = $this->createMock(Mailer::class);
        $mock_mailer->expects($this->once())
                    ->method('sendMessage')
                    ->with($this->equalTo('test@test.de'), $this->equalTo('Hello'))
                    ->willReturn(true);

        $this->user->setMailer($mock_mailer);
        $this->user->email = "test@test.de";

        $this->assertTrue($this->user->notify("Hello"));
    }

    public function testCannotNotifyUserWithoutEmail(): void 
    {
        $mock_mailer = $this->getMockBuilder(Mailer::class)
                            ->onlyMethods([])
                            ->getMock();

        $this->user->setMailer($mock_mailer);
        $this->expectException(Exception::class);
        $this->user->notify("Hello");
        
    }

}