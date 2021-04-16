<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


 class ResetPasswordFormTest extends TestCase
{

  /**
      * @runInSeparateProcess
      */
  public function testResetPasswordSuccessfulWhenValidInput(): void
  {
         require 'functions/login.inc.php';
         require 'functions/dbh.inc.php';
         require_once 'functions/Token.php';
         $_POST['token'] = Token::generate();
         $_POST['newPasswordSubmit'] = "submit";
         $_POST['email'] = "math@email.com";
         $_POST['password1'] = "newTestPwd";
         $_POST['password2'] = "newTestPwd";
        $this->assertEquals(NULL,resetpassword($conn));
  }

  public function testResetPasswordFailsWhenNullInput(): void
  {
         require 'functions/login.inc.php';
         require 'functions/dbh.inc.php';
         require_once 'functions/Token.php';
         $_POST['token'] = Token::generate();
         $_POST['newPasswordSubmit'] = "submit";
         $_POST['email'] = "";
         $_POST['password1'] = "";
         $_POST['password2'] = "";
         $error = "invalid password/email";
         $this->expectOutputString($error);
         resetPassword($conn);
  }

  public function testResetPasswordFailsWhenInvalidEmail(): void
  {
         require 'functions/dbh.inc.php';
         require_once 'functions/Token.php';
         $_POST['token'] = Token::generate();
         $_POST['newPasswordSubmit'] = "submit";
         $_POST['email'] = "123";
         $_POST['password1'] = "newTestPwd";
         $_POST['password2'] = "newTestPwd";
         $error = "invalid password/email";
         $this->expectOutputString($error);
         resetPassword($conn);
  }


    public function testResetPasswordFailsWhenInvalidPassword(): void
    {
           require 'functions/dbh.inc.php';
           require_once 'functions/Token.php';
           $_POST['token'] = Token::generate();
           $_POST['newPasswordSubmit'] = "submit";
           $_POST['email'] = "math@email.com";
           $_POST['password1'] = "newTestPwd";
           $_POST['password2'] = "newTest";
           $error = "invalid password/email";
           $this->expectOutputString($error);
           resetPassword($conn);
    }



}
