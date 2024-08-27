<?php

use PHPUnit\Framework\TestCase;

class MockTest extends TestCase
{   
    protected $mock;

    protected function setUp(): void
    {
        $this->mock = $this->createMock(Mailer::class);
        $this->mock->method('sendMessage')->willReturn(true);
        
    }

    public function testMock(): void
    {
        $result = $this->mock->sendMessage('test@test.de', 'Hello');

        $this->assertTrue($result);
    }
}