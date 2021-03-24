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
<?php include('chats/header.php') ?>


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
		 <button type="button" class="btn btn-outline-light btn-lg" onclick="location.href='chats/teacherLogin.php'">Teacher Login</button>
     <?php
     if(isset($_SESSION['id'])){
     echo "<button type='button' class='btn btn-primary btn-lg'  onclick=location.href='chats/chats.php'><a href='chats/chats.php'>Chat Page</button>";
     }else{
      echo "<button type='button' class='btn btn-primary btn-lg'  onclick=location.href='chats/roomID.php'>Chat Page</button>";
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
      <a href="chats/registerTeacher.php" type="button" class="btn btn-outline-secondary btn-lg">Register Now</button></a>

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
      <i class="fas fa-code"></i>
			<h3>Student</h3>
			<p>Enter the chat page with your teacher's room ID code.</p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<i class="fas fa-bold"></i>
			<h3>Teacher</h3>
			<p>Register to set up a room for your students</p>
		</div>
		<div class="col-sm-12 col-md-4">
			<i class="fab fa-css3"></i>
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
     <br><br>
          <p>1)place term and conditions in this space.
					</p>
						<p>2)place term and conditions in this space.
						</p>
							<p>3)place term and conditions in this space.
							</p>
            <br>

		</div>
		<div class="col-lg-6">
			<img src="img/desk.png" class="img-fluid">
		</div>
	</div>
</div>



<hr class="my-4">
<!--- Meet the team -->
<div class="container-fluidf padding" id="About">
	<div class="row welcome text-center">
		<div class="col-12">
			<h2 class="display-4">Behind UtopiaNet</h2>
		</div>
		<br>
	</div>
</div>


<!--- Cards -->
<div class="container-fluid padding">
	<div class="row padding">

	<div class="col-md-6">
		<div class="card">
		<img class="card-img-top" src="img/team2.png">
		<div class="card-body">
			<h4 class="card-title">Salma Mahmood</h4>
				<p>Salma is a final year Computer Science student at Aston University</p>
				<a href="#" class="btn btn-outline-secondary">See profile</a>
		</div>


</div>
</div>
<div class="col-md-6">
  <div class="card">
  <img class="card-img-top" src="img/team3.png">
  <div class="card-body">
    <h4 class="card-title">Inspiration behind UtopiaNet</h4>
      <p>Learn more about how the global pandemic inspired UtopiaNet</p>
      <a href="#" class="btn btn-outline-secondary">See more</a>
  </div>
</div>
</div>

</div>
</div>



<!--- Two Column Section -->
<div class="container-fluid padding" id="Philosophy">
	<div class="row padding">
		<div class="col-lg-6">
     <h2>Our Philosophy...</h2>
          <p>The purpose of UtopiaNet is to connect students and teachers in a time where distant
          learning is becoming increasingly more common.</p>
						<p>We believe it is important to ensure the level of eductation that students are recieving
              are of the highest quality.<p>
                <p>With distant learning on the rise we understand the social presence factor
                  is missing among students. We aim to fill that gap by providing students a safe
                  space where they are able to help each other whilst removing the fear of
                  being judged by peers.<p>
            <br>
		</div>
		<div class="col-lg-6">
			<img src="img/bootstrap2.png" class="img-fluid">
		</div>
	</div>
	<hr class="my-4">
</div>
<!--- Connect -->
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-12">
			<h2>Connect</h2>
		</div>
		<!---need to fill in the hashtags with links later -->
		<div class="col-12 social padding">
			<a href="#"><i class="fab fa-facebook"></i></a>
					<a href="#"><i class="fab fa-twitter"></i></a>
							<a href="#"><i class="fab fa-google-plus-g"></i></a>
									<a href="#"><i class="fab fa-instagram"></i></a>
											<a href="#"><i class="fab fa-youtube"></i></a>
											</div>
										</div>
									</div>


<!--- Footer -->
<?php include('chats/footer.php'); ?>



<script>
	var scroll = new SmoothScroll('a[href*="#"]');
</script>


</body>
</html>
