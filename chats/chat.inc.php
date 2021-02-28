<?php

function setComments($conn){
  if(isset($_POST['commentSubmit'])){
$message_title = "Question/feedback:";
$uid = $_POST['uid'];
$date = $_POST['date'];
$message = $_POST['message'];
$votes = 0;
$message_with_title = $message_title . ' '. $message;

$sql = "INSERT INTO chat (uid, date, message, votes)
 VALUES ('$uid', '$date', '$message_with_title', '$votes')";

$result = $conn->query($sql);
  }
}

function getComments($conn){
$limit = 7;

$page_query = "SELECT * FROM chat";
$page_result = $conn->query($page_query);
$number_of_results = mysqli_num_rows($page_result);
$number_of_pages = ceil($number_of_results/$limit);


if(!isset($_GET['page'])){
$page = 1;
} else{
$page = $_GET['page'];
}

$start_limit = ($page-1)*$limit;

if(isset($_POST['dateEarliest'])){
    $sql = "SELECT * FROM chat ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
    $result = $conn->query($sql);
  }
  elseif(isset($_POST['dateLatest'])){
      $sql = "SELECT * FROM chat ORDER BY date ASC LIMIT " . $start_limit . ',' . $limit;
      $result = $conn->query($sql);
    }
  elseif(isset($_POST['vote'])){
        $sql = "SELECT * FROM chat ORDER BY votes DESC LIMIT " . $start_limit . ',' . $limit;
        $result = $conn->query($sql);
      }
  else{
    $sql = "SELECT * FROM chat ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
    $result = $conn->query($sql);
  }


while ($row = $result->fetch_assoc()){
  echo" <div class = 'container mt-2 col-sm-12 col-lg-9 bg-light' tabindex='0'>";
echo $row['date']."<br>";
echo nl2br($row['message']);
  echo"</p>
  <form class ='upvote-form' method= 'POST' action='".upvote($conn)."'>
  <input type = 'hidden' name='cid' value = '".$row['cid']."'>
  <button type = 'submit' name = 'upvote'>Upvote</button>
  </form>
  <form class='delete-form' method='POST' action='".deleteComments($conn)."'>
  <input type = 'hidden' name='cid' value = '".$row['cid']."'>
  <button type = 'submit' name = 'commentDelete'>Delete</button>
  </form>
  </form>
  <form class='edit-form' method='POST' action='replycomment.php'>
  <input type = 'hidden' name='cid' value = '".$row['cid']."'>
  <input type = 'hidden' name='uid' value = '".$row['uid']."'>
  <input type = 'hidden' name='date' value = '".$row['date']."'>
  <input type = 'hidden' name='message' value = '".$row['message']."'>
  <button>Reply</button>

  </form>

  </div>";
}

echo '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">';
for ($page=1;$page<=$number_of_pages;$page++){
echo '<li class="page-item" ><a class="page-link" href="chats.php?page=' .$page. '">'  .$page.  '</a></li>';
}


echo '
  </ul>
</nav>';
}


function deleteComments($conn){
  if(isset($_POST['commentDelete'])){
$cid = $_POST['cid'];

$sql = "DELETE FROM chat WHERE cid='$cid'";
$result = $conn->query($sql);
header("Location: chats.php");
  }
}

function replyComments($conn){
  if(isset($_POST['commentReply'])){
$reply = "Reply:";
$cid = $_POST['cid'];
$uid = $_POST['uid'];
$date = $_POST['date'];
$message = $_POST['message'];
$message1 = '\r\n'.'\r\n'. $reply . ' ' . $message;

$sql = "UPDATE chat SET message=CONCAT(message, '$message1') WHERE cid ='$cid'";
$result = $conn->query($sql);
header("Location: chats.php");
  }
}


function upvote($conn){

  if(isset($_POST['upvote'])){
  $cid = $_POST['cid'];
   $sql = "UPDATE chat SET votes = votes+1  WHERE cid='$cid' ";
  $result = $conn->query($sql);
}
}
