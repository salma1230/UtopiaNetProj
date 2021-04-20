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
      <h2>Add A Question</h2>
      <?php if(isset($message)){
        echo "<h4>" . $message . "</h4>";
      } ?>

<?php
  echo " <form method='POST' action='".addquestion($conn)."'>
          <p>
            <label>Question Number:</label>
            <input type='number' name='question_number' value='".$_SESSION['nextQuestion']."'>
          </p>
          <p>
            <label>Question Text:</label>
            <input type='text' name='question_text'>
          </p>
          <p>
            <label>Choice 1:</label>
            <input type='text' name='choice1'>
          </p>
          <p>
            <label>Choice 2:</label>
            <input type='text' name='choice2'>
          </p>
          <p>
            <label>Choice 3:</label>
            <input type='text' name='choice3'>
          </p>
          <p>
            <label>Choice 4:</label>
            <input type='text' name='choice4'>
          </p>
          <p>
            <label>Choice 5:</label>
            <input type='text' name='choice5'>
          </p>
          <p>
            <label>Correct Option Number</label>
            <input type='number' name='correct_choice'>
          </p>
            <input type = 'hidden' name = 'token' value = '".Token::generate()."'>
          <input type='submit' name='submit' value ='submit'>


      </form>
    </div>
  	</main>
    "?>


<!--- Footer -->
<?php include('footer1.php') ?>
  </body>
</html>
