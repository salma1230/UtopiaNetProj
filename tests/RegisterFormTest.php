<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


 class RegisterFormTest extends TestCase
{

  /**
      * @runInSeparateProcess
      */
  public function testRegisterReturnsSuccessfulwhenValidInput(): void {
        require 'functions/dbh.inc.php';
        require_once 'functions/Token.php';
        require 'functions/login.inc.php';
        $_POST['token'] = Token::generate();
        $_POST['regSubmit'] = "register";
        $username = $_POST['username'] = "San";
        $pwd = $_POST['password'] = "San";
        $_POST['email'] = "sani@email.com";
        reg($conn);

        //Check if the user is in the database.
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $conn->query($sql);
        $this->assertNotEquals(
           0,
           mysqli_num_rows($result),
           "actual value is equals to expected"
       );

       //Delete test comment from the database
        $sql2 = "DELETE FROM users WHERE username = '$username'";
        $result = $conn->query($sql2);

  }

  public function testRegisterFailsWhenNullValuesSubmitted() : void{
    require 'functions/dbh.inc.php';
    require_once 'functions/Token.php';
    require 'functions/login.inc.php';
    $_POST['token'] = Token::generate();
    $_POST['regSubmit'] = "register";
    $username = $_POST['username'] = "";
    $pwd = $_POST['password'] = "";
    $_POST['email'] = "";
    $error = "A valid username has not been entered";
    $this->expectOutputString($error);
    reg($conn);
  }


  public function testRegisterFailsWhenInvalidEmail() : void{
    require 'functions/dbh.inc.php';
    require_once 'functions/Token.php';

    $_POST['token'] = Token::generate();
    $_POST['regSubmit'] = "register";
    $username = $_POST['username'] = "San";
    $pwd = $_POST['password'] = "San";
    $_POST['email'] = "001";
    $error = "invalid email";
    $this->expectOutputString($error);
    reg($conn);
  }

  public function testRegisterChecksUserLoggedIn(): void {
         require 'functions/dbh.inc.php';
         require_once 'functions/Token.php';
         $_POST['token'] = Token::generate();
         $_POST['regSubmit'] = "register";
         $_SESSION['id'] = "2";
         $error = "You are already registered.";
         $this->expectOutputString($error);
         reg($conn);
  }

  public function testReadable_Random_StringReturnsString(): void
  {
    //Checks if each word is of length 6
      
         $word = readable_random_string($length = 6);
         $this->assertIsString($word,"String not returned");
         $this->assertEquals(6,strlen($word));
  }

}
