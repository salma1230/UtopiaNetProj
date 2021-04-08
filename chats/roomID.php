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
     <title>Chatwall</title>
  <?php include('../scripts/scripts.php'); ?>
     <link href="../css/style.css" rel="stylesheet">
     <link href="../css/style3.css" rel="stylesheet">
   </head>


   <body>
     <!-- Navigation Needs updating -->
<?php include('navbar.php'); ?>
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


<!--RoomID Section-->
  	<div class="d-flex justify-content-center h-100">
  		<div class="card">
  			<div class="card-header">
  				<h3>Enter Room ID</h3>

  			</div>
  			<div class="card-body">
          <?php
  	echo"	<form method='POST' action= '".validRoom($conn)."'>
  					<div class='input-group form-group'>
  						<div class='input-group-prepend'>
  							<span class='input-group-text'><i class='fas fa-user'></i></span>
  						</div>
  						<input type='text' maxlength='6' class='form-control' name='roomID' placeholder='roomID'>
  					</div>
              <input type = 'hidden' name = 'token' value = '".Token::generate()."'>
          	<div class='form-group'>
  						<input type='submit' value='Enter' name='roomIDSubmit' class='btn float-right login_btn'>
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
