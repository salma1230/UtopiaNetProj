<?php

echo "<nav class='navbar navbar-expand-md navbar-light bg-light fixed-top'>
	<div class = 'container-fluid'>
		<a class='navbar-brand' href='#'><img src='img/logo2.png'></a>

<button class = 'navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarResponsive'>
<span class='navbar-toggler-icon'></span>
</button>

<div class='collapse navbar-collapse' id='navbarResponsive'>
 <ul class='navbar-nav ml-auto'>
	 <li class='nav-item'>
		 <a class='nav-link' href='index.php'>Home</a>
	 </li>
	 <li class='nav-item'>
		 <a class='nav-link' href='#welcome'>Get started</a>
	 </li>
	 <li class='nav-item'>
		 <a class='nav-link' href='#Terms'>T&C</a>
	 </li>
	 <li class='nav-item'>
		 <a class='nav-link' href='#About'>About Us</a>
	 </li>
	 <li class='nav-item'>
		 <a class='nav-link' href='#Philosophy'>Philosophy</a>
	 </li>";
	  if(isset($_SESSION['id'])){
	  echo "<li class='nav-item'>
     <a class='nav-link' href='pages/chats.php'>Chat Page</a>
   </li>";
	  }else{
			echo "<li class='nav-item'>
	     <a class='nav-link' href='pages/roomID.php'>Chat Page</a>
	   </li>";
	 }
   echo "
  <li class='nav-item'>
   <a class='nav-link' href='pages/teacherLogin.php'>Teacher Login</a>
 </li>
   ";

 if(isset($_SESSION['id'])){
 echo "<form method= 'POST' action= '".userLogout()."'>
 <button  class='btn btn-light' type='submit' name='logoutSubmit'>Log Out</button>
 </form>";
 }else{
}

 echo "</ul>
</div>

	</div>
</nav>";
?>
