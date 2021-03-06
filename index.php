<?php
date_default_timezone_set('Europe/London');
include 'functions/dbh.inc.php';
include 'functions/chat.inc.php';
include 'functions/login.inc.php';
//server keeps the session data for 3 hours
ini_set('session.gc_maxlifetime', 10800);
session_start();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>UtopiaNet</title>
	<?php include('scripts/scripts.php') ?>
	<link href="css/style.css" rel="stylesheet">

</head>

<body>



<!-- Navigation -->
<?php include('pages/header.php') ?>


<!--- Image Slider -->
<div id="slides" class ="carousel slide" data-ride="carousel">
 <ul class="carousel-indicators">
	 <li data-target="#slides" data-slide-to="0"></li>

</ul>
<div class="carousel-inner">
 <div class="carousel-item active">
	 <img src="img/background.png">
	 <div class="carousel-caption">
		 <h1 class="display-2">UtopiaNet</h1>
		 <h3>Helping students help each other</h3>
		 <button type="button" class="btn btn-outline-light btn-lg" onclick="location.href='pages/teacherLogin.php'">Teacher Login</button>
     <?php
     if(isset($_SESSION['id'])){
     echo "<button type='button' class='btn btn-primary btn-lg'  onclick=location.href='pages/chats.php'><a href='pages/chats.php'>Chat Page</button>";
     }else{
      echo "<button type='button' class='btn btn-primary btn-lg'  onclick=location.href='pages/roomID.php'>Chat Page</button>";
     }
     ?>

	 </div>
 </div>
</div>
</div>


<!--- Jumbotron -->
<div class="container-fluid" >
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
    <p class="lead"> UtopiaNet is a learning platform aided to promote engagement between students
		under the teacher's supervision. If you are a teacher sign up today by clicking 'Register Now'.</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
      <a href="pages/registerTeacher.php" type="button" class="btn btn-outline-secondary btn-lg">Register Now</button></a>

		</div>
	</div>
</div>

<!--- Welcome Section -->
<div class="container-fluid padding"id="welcome">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Helping to build a brighter future</h1>
		</div>
		<hr>
		<div class="col-12">
			<p class="lead">Chat anonymously with other students</p>
		</div>
</div>
</div>

<!--- Three Column Section -->
<section id = "Terms">
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-xs-12 col-sm-6 col-md-4">
			<h3>Student</h3>
			<p>Enter the chat page with your teacher's room ID code.</p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<h3>Teacher</h3>
			<p>Register to set up a room for your students</p>
		</div>
		<div class="col-sm-12 col-md-4">
			<h3>Institution</h3>
			<p>Get in contact with us to discuss a more personalised system for your institution.</p>
		</div>
	</div>
	<hr class="my-4">
</div>
</section>

<!--- Two Column Section -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-lg-6">
     <h2>Terms and Conditions</h2>
          <p>By registering and using UtopiaNet's services you are agreeing to use this system
            for the purpose intended as follows:</p> <br>
            <h3>Accounts and Membership</h3>
            <p>If you create an account on the Website, you are responsible for maintaining the security of your account and you are fully responsible
              for all activities that occur under the account and any other actions taken in connection with it.
              We may, but have no obligation to, monitor and review new accounts before you may sign in and start using the Services.
              Providing false contact information of any kind may result in the termination of your account.
               You must immediately notify us of any unauthorized uses of your account or any other breaches of security
               . We will not be liable for any acts or omissions by you, including any damages of any kind incurred as a result of such acts or omissions. We may suspend, disable, or delete your account (or any part thereof) if we determine that you have violated any provision of this Agreement or that your conduct or content would tend to damage our reputation and goodwill. If we delete your account for the foregoing reasons, you may not re-register for our Services. We may block your email address and Internet protocol address to prevent further registration.</p>
               <p> More information on our Terms and Conditions can be found here: </P>
            <a href =" https://www.websitepolicies.com/policies/view/r6StI5yM">https://www.websitepolicies.com/policies/view/r6StI5yM</a>
            <br>

		</div>
		<div class="col-lg-6">
			<img src="img/desk.png" class="img-fluid">
		</div>
	</div>
</div>



<hr class="my-4">

<!--- Two Column Section -->
<div class="container-fluid padding" id="Philosophy">
	<div class="row padding">
		<div class="col-lg-6">
     <h2>Our Philosophy</h2>
          <p>The purpose of UtopiaNet is to connect students and teachers in a time where distant
          learning is becoming increasingly more common.</p>
						<p>We believe it is important to ensure the level of eductation that students are recieving
              are of the highest quality.<p>
                <p>With distant learning on the rise we understand the social presence factor
                  is missing among students. We aim to fill that gap by providing students a safe
                  space where they are able to ask for help and help others anonymously, thus
                  removing the fear of being judged by peers.<p>
                    <p>UtopiaNet's chat page allows students to submit, upvote and reply to each other's posts, the reasons
                      for promoting students to communicate with each other is because here at UtopiaNet we believe sometimes students are able to explain certain things
                       in a way that is more understanding for some students.
                       Thus allowing students to help each other clear their doubts and in the process
                       a teacher’s workload as well.
                    <p>UtopiaNet's quiz feature allows teachers to set multiple choice quizzes for students, to allow students to test their own knowledge.
                      Students are able to take these quizzes anonymously and receive their score at the end of the quiz.
                      The reason for including a quiz feature along with the chat page is to promote more discussion amongst students about which questions they found difficult, to which
                   teachers can also take a note of, allowing teachers to gain a better understanding of the overall students' engagement with class material.
</p>
            <br>
		</div>
		<div class="col-lg-6">
			<img src="img/team3.png" class="img-fluid">
		</div>
	</div>
	<hr class="my-4">
</div>

<!--- Footer -->
<?php include('pages/footer.php'); ?>



<script>
	var scroll = new SmoothScroll('a[href*="#"]');
</script>


</body>
</html>
