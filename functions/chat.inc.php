<?php
/**
 * Generates a  new comment and inserts it as a new row into 'chat' database when user submits a question/post, called in 'chats.php'.
 *
 * param:connection to database ''$conn'
 *
 * returns: None.
 */
function setComments($conn){
  //if the button named 'commentSubmit' is selectd by the user insert it under a new row in the 'chat' table.
  if(isset($_POST['commentSubmit'])){
  //retrieve the current roomID
  $room = $_SESSION['roomID'];
  //Retieve relevant information from comment
  $message_title = "Question/feedback:";
  $uid = $_POST['uid'];
  $date = $_POST['date'];
  $message = $_POST['message'];
  $message_with_title = $message_title . ' '. $message;
  //set the votes to 0
  $votes = 0;

  //Insert new comment data into a new row in 'chat' Table
  $sql = "INSERT INTO chat (uid, date, message, votes, roomID)
  VALUES ('$uid', '$date', '$message_with_title', '$votes', '$room')";

   $result = $conn->query($sql);
  }
}

/**
 * Displays all relevant posts from the database table 'chat' onto the page.
 *
 * param: Connection to database '$conn'
 *
 * return all comments whose roomID matches the current roomID..
 */
function getChatComments($conn){
//current roomID is stored into variable $room
$room = $_SESSION['roomID'];
//maximum posts per page is set as 7.
$limit = 7;


//selects all rows from 'chat' table equal to roomID and stores the number of pages required in $number_of_pages
$page_query = "SELECT * FROM chat WHERE roomID = '$room'";
$page_result = $conn->query($page_query);
$number_of_results = mysqli_num_rows($page_result);
$number_of_pages = ceil($number_of_results/$limit);

//if there is no current page then page = 1 else get the current page number
if(!isset($_GET['page'])){
$page = 1;
} else{
$page = $_GET['page'];
}

//calculates starting row number the comments should be selected from in 'chat' Table.
$start_limit = ($page-1)*$limit;


//rows are assorted accordingly, depending on 'Search By' dropdown selection by the user.
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
//if user has not selected any option than comments presented by date as default.
  else{
    $sql = "SELECT * FROM chat WHERE roomID = '$room' ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
    $result = $conn->query($sql);
  }


//retrieves data from each row retrieved from the database and displays it to the page.
while ($row = $result->fetch_assoc()){
  echo" <div class = 'container mt-2 col-sm-12 col-lg-9 bg-light' tabindex='0'>";
echo $row['date']."<br>";
echo nl2br($row['message']);

//if user is logged in present 'Delete' and 'archive options'
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

//else if user is not logged in only present 'upvote' and 'replyComment'
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
//For each page display the page number at the bottom of the page
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
 * Displays all relevant posts from the database table 'archives' onto the page.
 *
 * param: Connection to database '$conn'
 *
 * return all comments whose roomID matches the current roomID..
 */

function getArchives($conn){
    //current roomID is stored into variable $room
    $room = $_SESSION['roomID'];
    //maximum posts per page is set as 7.
    $limit = 7;

    //selects all rows from 'archive' table equal to roomID and stores the number of pages required in $number_of_pages
    $page_query = "SELECT * FROM archives WHERE roomID = '$room'";
    $page_result = $conn->query($page_query);
    $number_of_results = mysqli_num_rows($page_result);
    $number_of_pages = ceil($number_of_results/$limit);

    //if there is no current page then page = 1 else get the current page number
    if(!isset($_GET['page'])){
    $page = 1;
    } else{
    $page = $_GET['page'];
    }
    //calculates starting row number the comments should be selected from in 'archives' Table.
    $start_limit = ($page-1)*$limit;

    //rows are assorted accordingly, depending on 'Search By' dropdown selection by the user.
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
      //if user has not selected any option than comments presented by date as default.
      else{
        $sql = "SELECT * FROM archives WHERE roomID = '$room' ORDER BY date DESC LIMIT " . $start_limit . ',' . $limit;
        $result = $conn->query($sql);
      }

    //retrieves data from each row retrieved from the database and displays it to the page.
    while ($row = $result->fetch_assoc()){
      echo" <div class = 'container mt-2 col-lg-9 bg-light' tabindex='0'>";
    echo $row['date']."<br>";
    echo nl2br($row['message']);
    //if user is logged in present 'Delete' option
    if(isset($_SESSION['id'])){
     echo "</p>
      <form class='delete-form-2' method='POST' action='".deleteArchiveComments($conn)."'>
      <input type = 'hidden' name='cid' value = '".$row['cid']."'>
      <button type = 'submit' name = 'commentDelete'>Delete</button>
      </form>
      </div>";
    }
      //if user is not logged in then do not present any options.
    else{
      echo
      "</div>";
    }
    }
    //For each page display the page number at the bottom of the page
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
 * Deletes the relevant comment from the chat page.
 *
 * param: Connection to database '$conn'
 *
 * return:None.
 */

function deleteComments($conn){
  //if the button named 'commentDelete' is selected by the user
  if(isset($_POST['commentDelete'])){
    //retrieve the commentID
    $cid = $_POST['cid'];
    //Delete the relevant comment from the database.
    $sql = "DELETE FROM chat WHERE cid='$cid'";
    $result = $conn->query($sql);
    header("Location: chats.php");
  }
}
/**
 * Deletes the relevant comment from the archive page.
 *
 * param: Connection to database '$conn'
 *
 * return:None.
 */

function deleteArchiveComments($conn){
  //if the button named 'commentDelete' is selected by the user
  if(isset($_POST['commentDelete'])){
    //retrieve the commentID
    $cid = $_POST['cid'];
    //Delete the relevant comment from the archive page.
    $sql = "DELETE FROM archives WHERE cid='$cid'";
    $result = $conn->query($sql);
    header("Location: archive.php");
  }
}
/**
 * Generates a new row in the archive Table.
 *
 * param: Connection to database '$conn'
 *
 * returns: None
 */
function archive($conn){
  //if the button named 'setArchive' is selected by the user
  if(isset($_POST['setArchive'])){
  //retrieve the commentID
  $cid = $_POST['cid'];
  //Move the comment from the 'chat' Table to the 'archives' Table in the database
  $sql = "INSERT INTO archives SELECT * FROM chat WHERE cid = '$cid'";
  $sql2 = "DELETE FROM chat WHERE cid = '$cid'";
  $result = $conn->query($sql);
  $result2 = $conn->query($sql2);

   header("Location: chats.php?archiveSuccessful");
  }
}

/**
 * Generates a response to an existing comment.
 *
 * param: Connection to database '$conn'
 *
 * return:None
 */
function replyComments($conn){
  //if the button named 'commentReply' is selected by the user
  if(isset($_POST['commentReply'])){
  $reply = "Reply:";
  //Retrieve the 'cid', 'uid', 'date' and 'message' values of the comment
  $cid = $_POST['cid'];
  $uid = $_POST['uid'];
  $date = $_POST['date'];
  $message = $_POST['message'];
  //Increment the reply to the message
  $message1 = '\r\n'.'\r\n'. $reply . ' ' . $message;

  //concatonate the reply to the message and update its value in the 'chats' table.
  $sql = "UPDATE chat SET message=CONCAT(message, '$message1') WHERE cid ='$cid'";
  $result = $conn->query($sql);
  header("Location: chats.php");
  }
}

/**
 * Increments the post/comment's vote score.
 *
 * param: Connection to database '$conn'
 *
 * return:None
 */
function upvote($conn){

  if(isset($_POST['upvote'])){
  $cid = $_POST['cid'];
   $sql = "UPDATE chat SET votes = votes+1  WHERE cid='$cid' ";
  $result = $conn->query($sql);
}
}
