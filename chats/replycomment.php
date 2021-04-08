<?php
date_default_timezone_set('Europe/London');
include '../functions/dbh.inc.php';
include '../functions/chat.inc.php';
include '../functions/login.inc.php';
//server keeps the session data for 3 hours
ini_set('session.gc_maxlifetime', 10800);
session_start();
require_once '../functions/Token.php';
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatWall</title>
      <?php include('../scripts/scripts.php'); ?>
    <link href="../css/style2.css" rel="stylesheet">
  </head>
  <body>


    <!-- Navigation -->
<?php include('navbar.php'); ?>
    	 <li class="nav-item">
    		 <a class="nav-link" href="teacherLogin.php">Login</a>
    	 </li>
      <li class="nav-item">
       <a class="nav-link" href="archive.php">Archives</a>
     </li>

      <?php
if(isset($_SESSION['id'])){
echo"<form method= 'POST' action= '".userLogout()."'>
   <button  class='btn btn-light chat' type='submit' name='logoutSubmit'>Log Out</button>
  </form>";
}else{
}
        ?>
     </ul>
    </div>

    	</div>
    </nav>




<?php
$cid = $_POST['cid'];
$uid = $_POST['uid'];
$date = $_POST['date'];
$message = $_POST['message'];



echo "<form method='POST' action='".replyComments($conn)."'>
<div class='form-group'>
<input type = 'hidden' name='cid' value ='".$cid."'></input>
<input type = 'hidden' name='uid' value ='anonymous'></input>
<input type = 'hidden' name='date' value = '".date('Y-m-d H:i:s')."'></input>
<div class='container mt-2 col-sm-12 col-lg-9'>
  <div class='jumbotron'>
  <h3>$date</h3>
    <h3>$message</h3>
</div>

<textarea class = 'form-control mt-2 col-sm-12' placeholder='Type reply here'  name = 'message' rows= '3'> </textarea><br>
  <input type = 'hidden' name = 'token' value = '".Token::generate()."'>
<button type = 'submit' class='btn btn-primary btn-lg' name = 'commentReply' >Reply</button>
</div>
</div>
</form>";
?>

  </body>
</html>
