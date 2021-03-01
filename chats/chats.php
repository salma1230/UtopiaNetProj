<?php

date_default_timezone_set('Europe/London');
include 'dbh.inc.php';
include 'chat.inc.php';
include 'login.inc.php';
session_start();
 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chatwall</title>
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
    		 <a class="nav-link" href="../index.html">Home</a>
    	 </li>
    	 <li class="nav-item">
    		 <a class="nav-link" href="#">Demo</a>
    	 </li>
       <li class="nav-item">
        <a class="nav-link" href="#">Terms & Conditions</a>
      </li>
      <?php
echo"<form method= 'POST' action= '".userLogout()."'><li class='nav-item'>
 <a class='nav-link' href='#' type='submit' name='logout submit'>Log Out</a>
</li>
</form>"
;
       ?>
     </ul>
    </div>

    	</div>
    </nav>
<?php



echo "<form method='POST' action='".setComments($conn)."'>
<div class='form-group'>
<input type = 'hidden' name='uid' value = 'anonymous'></input>
<input type = 'hidden' name='date' value = '".date('Y-m-d H:i:s')."'></input>
<h4 class='text-left'>Question/feedback:<h4>
<textarea class = 'form-control col-xs-9 col-sm-9' name = 'message' rows= '3'> </textarea><br>
<button type = 'submit' class='btn btn-primary btn-lg' name = 'commentSubmit' >Submit</button>
</div>
<div class='dropdown'>
 <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
   Sort By
 </button>
</form>";

echo "<form method='POST' action='".getComments($conn)."'>
  <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
    <button class='dropdown-item' type='submit' name='vote'>Votes: High to Low</button>
    <button class='dropdown-item' type='submit' name ='dateEarliest'>Date: Earliest to Latest</button>
    <button class='dropdown-item' type='submit' name='dateLatest'>Date: Latest to Earliest</button>
  </div>
</div>
</form>";



?>


<!--- Footer -->
<footer>
<div class="container-fluid padding">
	<div class="row text-center">
		<div class="col-md-6">
			<img src="../img/logo2.png">
			<hr class="light">
			<p>Phone number here</p>
			<p>Email address</P>
			<p>Street Address</P>
			<p>Post code</P>
		</div>
		<div class="col-md-6">
		<hr class="light">
		<h5>Our hours</h5>
		<hr class="light">
		<p>Monday: 9am-5pm</p>
		<p>Saturday: 10am-4pm</p>
		<p>Sunday: closed</p>
	</div>
<div class="col-12">
	<hr class="light-100">
	<h5>&copy; UtopiaNet.com</h5>
</div>
</div>

</footer>
  </body>
</html>
