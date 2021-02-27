<?php
date_default_timezone_set('Europe/London');
include 'dbh.inc.php';
include 'chat.inc.php';
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ChatWall</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
    <link href="style2.css" rel="stylesheet">
  </head>
  <body>


<!-- Navigation -->
<nav class="navbar navbar-expand-md navbar-light bg-light sticky-top">
  <div class = "container-fluid">
    <a class="navbar-brand" href="#"><img src="../img/logo2.png"></a>

<button class = "navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="navbarResponsive">
 <ul class="navbar-nav ml-auto">
   <li class="nav-item">
     <a class="nav-link" href="#">Home</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="#">Get started</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="#">About</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="#">Team</a>
   </li>
   <li class="nav-item">
     <a class="nav-link" href="#">Connect</a>
   </li>
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
<div class='container col-sm-9'>
  <div class='jumbotron'>
  <h3>$date</h3>
    <h3>$message</h3>
</div>

<textarea class='form-control col-sm-9' placeholder='Type reply here' name='message' rows= '12'></textarea><br>
<button type = 'submit' name = 'commentReply' >Reply</button>
</div>
</form>";
?>

  </body>
</html>
