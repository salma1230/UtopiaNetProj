<?php
date_default_timezone_set('Europe/London');
include 'chats/dbh.inc.php';
include 'chats/chat.inc.php';
include 'chats/login.inc.php';
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
	<?php include('chats/scripts.php') ?>
	<link href="style.css" rel="stylesheet">
</head>

<body>



<!-- Navigation -->
<?php include('header.php') ?>


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
		 <button type="button" class="btn btn-primary btn-lg"  onclick="location.href='chats/chats.php'">Chat Page</button>
	 </div>
 </div>
</div>
</div>


<!--- Jumbotron -->
<div class="container-fluid" >
	<div class="row jumbotron">
		<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 col-xl-10">
    <p class="lead"> UtopiaNet is a learning platform aided to promote engagement between students
		under the teacher's supervision</p>
		</div>
		<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 col-xl-2">
      <a href="#" type="button" class="btn btn-outline-secondary btn-lg">Random button</button></a>

		</div>
	</div>
</div>

<!--- Welcome Section -->
<div class="container-fluid padding"id="welcome">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Built with ease</h1>
		</div>
		<hr>
		<div class="col-12">
			<p class="lead">This can be removed later if needed</p>
		</div>
</div>
</div>

<!--- Three Column Section -->
<section id = "demo">
<div class="container-fluid padding">
	<div class="row text-center padding">
		<div class="col-xs-12 col-sm-6 col-md-4">
      <i class="fas fa-code"></i>
			<h3>HTML5</h3>
			<p>Example of html5 p text. Can change icon in code later</p>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-4">
			<i class="fas fa-bold"></i>
			<h3>Bold version of html5</h3>
			<p>Example of html5 p text. Can change icon in code later</p>
		</div>
		<div class="col-sm-12 col-md-4">
			<i class="fab fa-css3"></i>
			<h3>HTML5</h3>
			<p>Example of html5 p text. Can change icon in code later</p>
		</div>
	</div>
	<hr class="my-4">
</div>
</section>

<!--- Two Column Section -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-lg-6">
     <h2>A 2 column block...</h2>
          <p>can place term and conditions in this space.
						Can also place the buttons here if you want</p>
						<p>can place term and conditions in this space.
							Can also place the buttons here if you want</p>
							<p>can place term and conditions in this space.
								Can also place the buttons here if you want</p>
            <br>
						<a href="#" class="btn btn-primary">Learn More</a>
		</div>
		<div class="col-lg-6">
			<img src="img/desk.png" class="img-fluid">
		</div>
	</div>
</div>



<hr class="my-4">
<!--- Meet the team -->
<div class="container-fluidf padding" id="team">
	<div class="row welcome text-center">
		<div class="col-12">
			<h1 class="display-4">Meet the team</h1>
		</div>
		<br>
	</div>
</div>


<!--- Cards -->
<div class="container-fluid padding">
	<div class="row padding">
		<div class="col-md-4">
			<div class="card">
			<img class="card-img-top" src="img/team1.png">
			<div class="card-body">
				<h4 class="card-title">John Doe</h2>
					<p>John is a ..........</p>
					<a href="#" class="btn btn-outline-secondary">See profile</a>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="card">
		<img class="card-img-top" src="img/team2.png">
		<div class="card-body">
			<h4 class="card-title">Mary Jo</h2>
				<p>Mary is a ..........</p>
				<a href="#" class="btn btn-outline-secondary">See profile</a>
		</div>
	</div>
</div>
<div class="col-md-4">
	<div class="card">
	<img class="card-img-top" src="img/team3.png">
	<div class="card-body">
		<h4 class="card-title">Phil Doe</h2>
			<p>Phil is a ..........</p>
			<a href="#" class="btn btn-outline-secondary">See profile</a>
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
          <p>can place term and conditions in this space.
						Can also place the buttons here if you want</p>
						<p>Can place demo or out infor about the site here<p>
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
<?php include('footer.php'); ?>



<script>
	var scroll = new SmoothScroll('a[href*="#"]');
</script>


</body>
</html>
