<?php
date_default_timezone_set('Europe/London');
include '../functions/dbh.inc.php';
include '../functions/chat.inc.php';
include '../functions/login.inc.php';
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
  <?php include('../scripts/scripts.php'); ?>
     <link href="../css/style3.css" rel="stylesheet">
      <link href="../css/style.css" rel="stylesheet">
   </head>


   <body>
     <!-- Navigation -->
<?php include('navbar.php'); ?>
      <li class="nav-item">
        <a class="nav-link" href="chats.php">Chat Page</a>
      </li>
     <li class="nav-item">
      <a class="nav-link" href="archive.php">Archives</a>
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


<!--ForgottenPassword Section-->
  	<div class="d-flex justify-content-center h-100">
  		<div class="card">
  			<div class="card-header">
  				<h3>Enter your account email</h3>

  			</div>
  			<div class="card-body">
          <?php
  	echo"	<form method='POST' action= '".sendEmail($conn)."'>

            <div class='input-group form-group'>
              <div class='input-group-prepend'>
                <span class='input-group-text'><i class='fas fa-user'></i></span>
              </div>
              <input type='text' name ='email' class='form-control' placeholder='email@example.com'>
            </div>
          	<div class='form-group'>
  						<input type='submit' value='reset' name='emailSubmit' class='btn float-right login_btn'>
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
<?php include('footer1.php') ?>

 </body>
  </html>
