<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


 class LoginFormTest extends TestCase
{

  /**
      * @runInSeparateProcess
      */
    public function testGetLoginSuccessfulWhenValidValues(): void {
      //returns true if login is successful
           require 'functions/dbh.inc.php';
           require 'functions/login.inc.php';
           require_once 'functions/Token.php';
           $_POST['token'] = Token::generate();
           $_POST['loginSubmit'] = "login";
           $_POST['username'] = "Tester1";
           $pwd = $_POST['password'] = "Tester123";
           $this->assertEquals(NULL,getLogin($conn));
    }

    public function testGetLoginFailsWhenNullValues(): void {
      //returns false when if username has no value
           require_once 'functions/Token.php';
           require 'functions/login.inc.php';
           require 'functions/dbh.inc.php';
           $_POST['token'] = Token::generate();
           $_POST['loginSubmit'] = "login";
           $_POST['username'] = "";
           $pwd = $_POST['password'] = "";
           $error = "Please enter username/password";
           $this->expectOutputString($error);
           getLogin($conn);
    }

    public function testGetLoginFailsWhenInvalidUsername(): void {
      //returns false when if username doesn't exist.
           require_once 'functions/Token.php';
           require 'functions/dbh.inc.php';
           $_POST['token'] = Token::generate();
           $_POST['loginSubmit'] = "login";
           $_POST['username'] = "001";
           $pwd = $_POST['password'] = "001";
           $error = "Incorrect username/password. Please try again";
           $this->expectOutputString($error);
           getLogin($conn);
    }

    public function testGetLoginReturnsErrorMessageWhenInvalidPassword(): void {
      //returns false when if username has no value/doesn't exist.
           require 'functions/dbh.inc.php';
           require_once 'functions/Token.php';
           $_POST['token'] = Token::generate();
           $_POST['loginSubmit'] = "login";
           $_POST['username'] = "Tester1";
           $pwd = $_POST['password'] = "001";
           $error = "Incorrect username/password. Please try again";
           $this->expectOutputString($error);
           getLogin($conn);
    }










}
