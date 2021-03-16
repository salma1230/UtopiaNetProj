<?php
/**
 * Generates.
 *
 * param
 *
 * return.
 */
function setComments($conn){
  if(isset($_POST['commentSubmit'])){
$room = $_SESSION['roomID'];
$message_title = "Question/feedback:";
$uid = $_POST['uid'];
$date = $_POST['date'];
$message = $_POST['message'];
$votes = 0;
$message_with_title = $message_title . ' '. $message;
$sql = "INSERT INTO chat (uid, date, message, votes, roomID)
 VALUES ('$uid', '$date', '$message_with_title', '$votes', '$room')";

$result = $conn->query($sql);
  }
}

/**
 * Generates.
 *
 * param
 *
 * return.
 */
function getComments($conn){
$room = $_SESSION['roomID'];

$limit = 7;

$page_query = "SELECT * FROM chat WHERE roomID = '$room'";
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
    $sql = "SELECT * FROM chat WHERE roomID = '$room' ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
    $result = $conn->query($sql);
  }
  elseif(isset($_POST['dateLatest'])){
      $sql = "SELECT * FROM chat WHERE roomID = '$room' ORDER BY date ASC LIMIT " . $start_limit . ',' . $limit;
      $result = $conn->query($sql);
    }
  elseif(isset($_POST['vote'])){
        $sql = "SELECT * FROM chat WHERE roomID = '$room' ORDER BY votes DESC LIMIT " . $start_limit . ',' . $limit;
        $result = $conn->query($sql);
      }
  else{
    $sql = "SELECT * FROM chat WHERE roomID = '$room' ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
    $result = $conn->query($sql);
  }


while ($row = $result->fetch_assoc()){
  echo" <div class = 'container mt-2 col-sm-12 col-lg-9 bg-light' tabindex='0'>";
echo $row['date']."<br>";
echo nl2br($row['message']);
if(isset($_SESSION['id'])){
 echo "</p>
  <form class='delete-form' method='POST' action='".deleteComments($conn)."'>
  <input type = 'hidden' name='cid' value = '".$row['cid']."'>
  <button type = 'submit' name = 'commentDelete'>Delete</button>
  </form>
  <form class='edit-form' method='POST' action='replycomment.php'>
  <input type = 'hidden' name='cid' value = '".$row['cid']."'>
  <input type = 'hidden' name='uid' value = '".$row['uid']."'>
  <input type = 'hidden' name='date' value = '".$row['date']."'>
  <input type = 'hidden' name='message' value = '".$row['message']."'>
  <button>Reply</button>
  </form>
  <form class ='upvote-form' method='POST' action='".archive($conn)."'>
  <input type = 'hidden' name='cid' value = '".$row['cid']."'>
  <button type = 'submit' name='setArchive'>Archive</button>
  </form>
  </div>";
}

else{
  echo"</p>
  <form class ='upvote-form' method= 'POST' action='".upvote($conn)."'>
  <input type = 'hidden' name='cid' value = '".$row['cid']."'>
  <button type = 'submit' name = 'upvote'>Upvote</button>
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
}

echo '<nav aria-label="Page navigation example">
  <br> <ul class="pagination justify-content-center">';
for ($page=1;$page<=$number_of_pages;$page++){
echo '<li class="page-item" ><a class="page-link" href="chats.php?page=' .$page. '">'  .$page.  '</a></li>';
}


echo '
  </ul>
</nav>';
}

/**
 * Generates.
 *
 * param
 *
 * return.
 */

function getArchives($conn){
    $limit = 7;
    $room = $_SESSION['roomID'];
    $page_query = "SELECT * FROM archives WHERE roomID = '$room'";
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
        $sql = "SELECT * FROM archives WHERE roomID = '$room' ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
        $result = $conn->query($sql);
      }
      elseif(isset($_POST['dateLatest'])){
          $sql = "SELECT * FROM archives WHERE roomID = '$room' ORDER BY date ASC LIMIT " . $start_limit . ',' . $limit;
          $result = $conn->query($sql);
        }
      elseif(isset($_POST['vote'])){
            $sql = "SELECT * FROM archives WHERE roomID = '$room' ORDER BY votes DESC LIMIT " . $start_limit . ',' . $limit;
            $result = $conn->query($sql);
          }
      else{
        $sql = "SELECT * FROM archives WHERE roomID = '$room' ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
        $result = $conn->query($sql);
      }


    while ($row = $result->fetch_assoc()){
      echo" <div class = 'container mt-2 col-lg-9 bg-light' tabindex='0'>";
    echo $row['date']."<br>";
    echo nl2br($row['message']);
    if(isset($_SESSION['id'])){
     echo "</p>
      <form class='delete-form-2' method='POST' action='".deleteComments($conn)."'>
      <input type = 'hidden' name='cid' value = '".$row['cid']."'>
      <button type = 'submit' name = 'commentDelete'>Delete</button>
      </form>
      </div>";
    }

    else{
      echo
      "</div>";
    }
    }

    echo '<nav aria-label="Page navigation example">
      <br><ul class="pagination justify-content-center">';
    for ($page=1;$page<=$number_of_pages;$page++){
    echo '<li class="page-item" ><a class="page-link" href="chats.php?page=' .$page. '">'  .$page.  '</a></li>';
    }


    echo '
      </ul>
    </nav>';
}

/**
 * Generates.
 *
 * param
 *
 * return.
 */

function deleteComments($conn){
  if(isset($_POST['commentDelete'])){
$cid = $_POST['cid'];

$sql = "DELETE FROM chat WHERE cid='$cid'";
$result = $conn->query($sql);
header("Location: chats.php");
  }
}

/**
 * Generates.
 *
 * param
 *
 * return.
 */
function archive($conn){
  if(isset($_POST['setArchive'])){
  $cid = $_POST['cid'];

  $sql = "INSERT INTO archives SELECT * FROM chat WHERE cid = '$cid'";
  $sql2 = "DELETE FROM chat WHERE cid = '$cid'";
  $result = $conn->query($sql);
  $result2 = $conn->query($sql2);

header("Location: chats.php?archiveSuccessful");
  }
}

/**
 * Generates.
 *
 * param
 *
 * return.
 */
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

/**
 * Generates.
 *
 * param
 *
 * return.
 */
function upvote($conn){

  if(isset($_POST['upvote'])){
  $cid = $_POST['cid'];
   $sql = "UPDATE chat SET votes = votes+1  WHERE cid='$cid' ";
  $result = $conn->query($sql);
}
}
