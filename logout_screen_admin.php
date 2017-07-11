<?php
$cookie_name = "last_login_time_admin";
 date_default_timezone_set ( "America/Chicago" );
$cookie_value = date("l jS \of F Y h:i:s A") ;


setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<html>
	<head> 
		<title> logout </title>
		<link rel = "stylesheet" href  = "log_in_out_screen.css">
	</head>

	<?php 
	session_start(); 
	// remove all session variables
	session_unset(); 

	// destroy the session 
	session_destroy(); 
	?>
	
	<body> 
		<header>
		<h1> The University of Texas at Dallas</h1>
		<nav> 
			<ul>
				Login to register for courses
				<li id = "loginout"> <a href = "login_screen.html">log in </a></li>
			</ul>
		</nav>
		<p> Course Planner </p>
		</header>
		<p> You have been logged out.. </p>

	

	</body>



</html>
