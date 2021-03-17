<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

 class ExampleTest extends TestCase
{
    public function testAddReturnsTheCorrectSum(): void
    {
           require 'functions/functions.php';
           $this->assertEquals(4, add(2,2));

    }

}
