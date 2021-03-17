<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

 class loginincTest extends TestCase
{
    public function testReadable_Random_StringReturnsString(): void
    {
          require 'functions/login.inc.php';
           $word = readable_random_string($length = 6);
           $this->assertIsString($word,"String not returned");
           $this->assertEquals(6,strlen($word));
    }

    public function testGetLoginReturnsFalse(): void {
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,getLogin($conn));
    }

    public function testUserLogoutReturnsFalse(): void {
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,userLogout($conn));
    }

    public function testRegisterReturnsFalse(): void {
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,reg($conn));
    }

    public function testValidRoomReturnsFalse(): void {
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,validRoom($conn));
    }




}
