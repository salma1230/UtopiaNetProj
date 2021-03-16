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
     <link href="../css/style2.css" rel="stylesheet">
   </head>
   <body>
     <!-- Navigation -->
<?php include('navbar.php'); ?>
       <li class="nav-item">
         <a class="nav-link" href="teacherLogin.php">Login</a>
       </li>
     	 <li class="nav-item">
     		 <a class="nav-link" href="chats.php">Chat Page</a>
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
<<?php
 echo "<h3 class='blockquote text-center'>
   Archive Page
   <br>Room ID: '".$_SESSION['roomID']."'
 </h3>";

?>
     <?php
     echo"<div class='dropdown'>
      <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
        Sort By
      </button>
     </form>";
     echo "<form method='POST' action='".getArchives($conn)."'>
       <div class='dropdown-menu' aria-labelledby='dropdownMenu2'>
         <button class='dropdown-item' type='submit' name='vote'>Votes: High to Low</button>
         <button class='dropdown-item' type='submit' name ='dateEarliest'>Date: Earliest to Latest</button>
         <button class='dropdown-item' type='submit' name='dateLatest'>Date: Latest to Earliest</button>
       </div>
     </form>";
     ?>

     <!--- Footer -->
<?php include('footer1.php') ?>
       </body>
     </html>
