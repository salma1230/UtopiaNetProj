<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


 class RoomIDFormTest extends TestCase
{
  /**
      * @runInSeparateProcess
      */
  public function testValidRoomSuccessfulWhenValidInput(): void {
    //returns false when if username has no value/doesn't exist.
         require 'functions/dbh.inc.php';
         require_once 'functions/Token.php';
         require 'functions/login.inc.php';
         $_POST['token'] = Token::generate();
         $_POST['roomIDSubmit'] = "Submit";
         $_POST['roomID'] = "ceyito";
         $this->assertEquals(NULL,validRoom($conn));
  }

  public function testValidRoomReturnsErrorMessageWhenNullRoomID(): void {
    //returns false when if username has no value/doesn't exist.
         require 'functions/dbh.inc.php';
         require_once 'functions/Token.php';
         require 'functions/login.inc.php';
         $_POST['token'] = Token::generate();
         $_POST['roomIDSubmit'] = "Submit";
         $_POST['roomID'] = "";
         $error = "No ID has been entered. Please provide the room ID.";
         $this->expectOutputString($error);
         validRoom($conn);

  }

  public function testValidRoomReturnsErrorMessageWhenInvalidRoomID(): void {
    //returns false when if username has no value/doesn't exist.
         require 'functions/dbh.inc.php';
         require_once 'functions/Token.php';
        $_POST['token'] = Token::generate();
         $_POST['roomIDSubmit'] = "Submit";
         $_POST['roomID'] = "wrong";
         $error = "This roomID does not exist. Please try again.";
         $this->expectOutputString($error);
         validRoom($conn);
  }




}
