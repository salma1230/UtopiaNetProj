<?php
date_default_timezone_set('Europe/London');
include '../functions/dbh.inc.php';
include '../functions/chat.inc.php';
include '../functions/login.inc.php';
include '../functions/quiz.inc.php';

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

    <link href="../css/style4.css" rel="stylesheet">
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

      <main>

    			<div class="container">
      <?php      echo "<form method='POST' action='".getQuestion($conn)."'> </form>";?>


    			</div>



      	</main>


<!--- Footer -->
<?php include('footer1.php') ?>
  </body>
</html>
