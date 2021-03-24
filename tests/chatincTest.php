<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;


 class chatincTest extends TestCase
{

  /**
      * @runInSeparateProcess
      */
    public function testSetCommentsReturnsTrueWhenInputCorrect(): void
    {
      require 'functions/dbh.inc.php';
      require 'functions/chat.inc.php';

      $_POST['commentSubmit'] = "submit";
      $_SESSION['roomID'] = "huyopa";
      $_POST['uid'] = "Test";
      $uid = $_POST['uid'];
      $_POST['date'] = "";
      $_POST['message'] = "SetCommentReturnsTrue";
      setComments($conn);
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
    public function testSetCommentsReturnsFalseWhenEmptyComment(): void
    {
      require 'functions/dbh.inc.php';
      require 'functions/chat.inc.php';
      $_POST['commentSubmit'] = "submit";
      $_SESSION['roomID'] = "huyopa";
      $_POST['uid'] = "Test";
      $_POST['date'] = "";
      $_POST['message'] = "";
      $this->assertEquals(False,setComments($conn));


    }

    /**
        * @runInSeparateProcess
        */
    public function testSetCommentsReturnsFalseWhenCommentTooLong(): void
    {
      require 'functions/dbh.inc.php';
      require 'functions/chat.inc.php';
      $_POST['commentSubmit'] = "submit";
      $_SESSION['roomID'] = "huyopa";
      $_POST['uid'] = "Test";
      $_POST['date'] = "";
      $_POST['message'] = "In addition to what Lawrence said about assigning a default value, one can now use the Null Coalescing Operator (PHP 7). Hence when we want to assign a default value we can write:
//assigns the fruit variable content to a if the fruit variable exists or has a value that is not NULL, or assigns the value 'apple' to a if the fruit variable doesn't exists or it contains the NULL value
";
      $this->assertEquals(False,setComments($conn));


    }

}
