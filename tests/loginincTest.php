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

    public function testGetLoginReturnsFalseWhenNotSubmitted(): void {
      //returns false when if 'loginSubmit' has no value.
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,getLogin($conn));
    }

    public function testGetLoginReturnsErrorMessageWhenInvalidUsername(): void {
      //returns false when if username has no value/doesn't exist.
           require 'functions/dbh.inc.php';
           $_POST['loginSubmit'] = "login";
           $_POST['username'] = "Salma123";
           $pwd = $_POST['password'] = "Salma123";
           $error = "That username does not exist";
           $this->expectOutputString($error);
           getLogin($conn);
    }

    public function testGetLoginReturnsErrorMessageWhenInvalidPassword(): void {
      //returns false when if username has no value/doesn't exist.
           require 'functions/dbh.inc.php';
           $_POST['loginSubmit'] = "login";
           $_POST['username'] = "Salma";
           $pwd = $_POST['password'] = "Sal";
           $error = "Incorrect Password. Please try again";
           $this->expectOutputString($error);
           getLogin($conn);
    }

    public function testUserLogoutReturnsFalse(): void {
        //returns false when if 'logoutSubmit' has no value.
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,userLogout($conn));

    }

    public function testRegisterReturnsFalseWhenNotSubmitted(): void {
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,reg($conn));
    }

    public function testRegisterChecksUserLoggedIn(): void {
           require 'functions/dbh.inc.php';
           $_POST['regSubmit'] = "register";
           $_SESSION['id'] = "2";
           $error = "You are already registered.";
           $this->expectOutputString($error);
           reg($conn);

    }


    public function testValidRoomReturnsFalse(): void {
           require 'functions/dbh.inc.php';
           $this->assertEquals(False,validRoom($conn));
    }
    
    public function testvalidroomReturnsErrorMessageWhenInvalidRoomID(): void {
      //returns false when if username has no value/doesn't exist.
           require 'functions/dbh.inc.php';
           $_POST['roomIDSubmit'] = "Submit";
           $_POST['roomID'] = "abc";
           $error = "<p>This roomID does not exist. Please try again.</p>";
           $this->expectOutputString($error);
           validRoom($conn);
    }




}
