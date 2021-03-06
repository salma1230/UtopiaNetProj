<?php
date_default_timezone_set('Europe/London');
include 'dbh.inc.php';
include 'chat.inc.php';
include 'login.inc.php';
//server keeps the session data for 3 hours
ini_set('session.gc_maxlifetime', 10800);
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
     <link href="style3.css" rel="stylesheet">
   </head>


   <body>
     <!-- Navigation -->
     <nav class="navbar fixed-top navbar-expand-md navbar-light bg-light sticky-top">
      <div class = "container-fluid">
        <a class="navbar-brand" href="#"><img src="../img/logo2.png"></a>

     <button class = "navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
     <span class="navbar-toggler-icon"></span>
     </button>

     <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
       <li class="nav-item">
         <a class="nav-link" href="../index.php">Home</a>
       </li>
       <?php

     if(isset($_SESSION['id'])){
     echo"<form method= 'POST' action= '".userLogout()."'>
     <button  class='btn btn-light' type='submit' name='logoutSubmit'>Log Out</button>
     </form>";
     }else{
     }
         ?>
      </ul>
     </div>

      </div>
     </nav>

     <!--- Image Slider -->
     <div id="slides" class ="carousel slide" data-ride="carousel">
     	<ul class="carousel-indicators">
     		<li data-target="#slides" data-slide-to="0"></li>

     </ul>
     <div class="carousel-inner">
     	<div class="carousel-item active">
     		<img src="../img/background7.png">
     		<div class="carousel-caption">
          <div class="container">


<!--Login Section-->
  	<div class="d-flex justify-content-center h-100">
  		<div class="card">
  			<div class="card-header">
  				<h3>Sign In</h3>

  			</div>
  			<div class="card-body">
          <?php
  	echo"	<form method='POST' action= '".getLogin($conn)."'>
  					<div class='input-group form-group'>
  						<div class='input-group-prepend'>
  							<span class='input-group-text'><i class='fas fa-user'></i></span>
  						</div>
  						<input type='text' class='form-control' name='username' placeholder='username'>
  					</div>

  					<div class='input-group form-group'>
  						<div class='input-group-prepend'>
  							<span class='input-group-text'><i class='fas fa-key'></i></span>
  						</div>
            	<input type='password' name ='password'class='form-control' placeholder='password'>
  					</div>

          	<div class='row align-items-center remember'>
  						<input type='checkbox'>Remember Me
  					</div>

          	<div class='form-group'>
  						<input type='submit' value='Login' name='loginSubmit' class='btn float-right login_btn'>
  					</div>
  				</form>";
          ?>
  			</div>
      </div>
	</div>


     	</div>
     </div>
   </div>
    </div>
     </div>





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
