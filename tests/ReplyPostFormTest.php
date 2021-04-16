<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


 class ReplyPostFormTest extends TestCase
{
  /**
      * @runInSeparateProcess
      */
  public function testReplyPostReturnsTrueWhenInputCorrect(): void
  {
    require 'functions/dbh.inc.php';
    require 'functions/chat.inc.php';
    require_once 'functions/Token.php';

    $_POST['token'] = Token::generate();
    $_POST['commentSubmit'] = "submit";
    $_SESSION['roomID'] = "huyopa";
    $_POST['uid'] = "Test";
    $uid = $_POST['uid'];
    $_POST['date'] = "";
    $_POST['message'] = "SetCommentReturnsTrue";
    replyComments($conn);


    //Check if the comment is in the database.
    $sql = "SELECT * FROM chat WHERE uid = '$uid'";
    $result = $conn->query($sql);
    $this->assertNotEquals(
       0,
       mysqli_num_rows($result),
       "actual value is equals to expected"
   );

   //Delete test comment from the database
    $sql2 = "DELETE FROM chat WHERE uid='$uid'";
    $result = $conn->query($sql2);
  }

  /**
      * @runInSeparateProcess
      */
  public function testSetCommentsReturnsFalseWhenNullInput(): void
  {
    require 'functions/dbh.inc.php';
    require 'functions/chat.inc.php';
    require_once 'functions/Token.php';
    $_POST['token'] = Token::generate();
    $_POST['commentSubmit'] = "submit";
    $_SESSION['roomID'] = "huyopa";
    $_POST['uid'] = "Test";
    $_POST['date'] = "";
    $_POST['message'] = "";
    $this->assertEquals(False,replyComments($conn));


  }

  /**
      * @runInSeparateProcess
      */
  public function testSetPostReturnsFalseWhenInvalidInput(): void
  {
    require 'functions/dbh.inc.php';
    require 'functions/chat.inc.php';
    require_once 'functions/Token.php';
    $_POST['token'] = Token::generate();
    $_POST['commentSubmit'] = "submit";
    $_SESSION['roomID'] = "huyopa";
    $_POST['uid'] = "Test";
    $_POST['date'] = "";
    $_POST['message'] = "In addition to what Lawrence said about assigning a default value, one can now use the Null Coalescing Operator (PHP 7). Hence when we want to assign a default value we can write:
//assigns the fruit variable content to a if the fruit variable exists or has a value that is not NULL, or assigns the value 'apple' to a if the fruit variable doesn't exists or it contains the NULL value
";
    $this->assertEquals(False,replyComments($conn));


  }


}
