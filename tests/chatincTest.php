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


      $sql2 = "DELETE FROM chat WHERE uid='$uid'";
      $result = $conn->query($sql2);
    }

    public function testSetCommentsReturnsFalseWhenInputIncorrect(): void
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

}
