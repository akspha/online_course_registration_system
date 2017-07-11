<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "update_grades_Admin.css">
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<link rel="stylesheet" type="text/css" href="./jquery.datetimepicker.css"/>
		<style type="text/css">

		.custom-date-style {
			background-color: red !important;
		}

		.input{	
		}
		.input-wide{
			width: 500px;
		}

		</style>
	</head>
	<?php session_start();?>
	<body>
		<header>
			<h1 id = "utdWordMark">  The University of Texas at Dallas </h1>
			<nav> 
				<ul>
					
					<li> <a href = "approve_courses.php"> Approvals,Transfers&Waivers course </a> </li>
					<li>&nbsp;</li>
					<li> <a href = "update_courses.php">  Add/Remove courses </a> </li>
					<li>&nbsp;</li>
					<li> <a href = "update_grades_Admin.php"> Add grades</a> </li>
					<li>&nbsp;</li>
					<li><a href = "update_degree_Admin.php"> Add/Remove Degree Plan </a></li>
					<li><a href = "update_user_Admin.php"> Add/Remove User </a> </li>
					<li><a href = "set_appointment_time_admin.php" > Set appointment times</a></li>
					<li><a href = "manage_appointments.php" > Manage appointments</a></li>
					<li id = "loginout"> <a href = "logout_screen.php">logout </a></li>
				</ul>
			</nav>
		
		<br/>
		</header>
		<div id  = "content">
			<h3>Set times when you would be available for advising</h3>


			<form method = "post" action = "set_appointment_time_admin.php">
				<input type="text"  name = "dateTimeValue" id="datetimepicker"/>
				<input class = "buttons" type = "submit" name = "set" value = "set"/>
				<input class = "buttons" type = "reset" value = "Clear"/><br/>
			</form>

			<script src="./jquery.js"></script>
			<script src="build/jquery.datetimepicker.full.js"></script>

			<script>
			$.datetimepicker.setLocale('en');

			
			$('#datetimepicker').datetimepicker({step: 30});
			</script>

			<?php 
			extract($_POST);

			//storing details in database ;
			//establishing a connection to database
			$servername = "localhost";
			$username = "akspha";
			$password = "akspha";
			$dbname = "mydatabase";
			$error = "" ;

			// Create connection
			$conn = new mysqli($servername, $username, $password,$dbname);
			// Check connection
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			}

			if(!empty($set) && strtotime($dateTimeValue)!= strtotime('1970-01-01 01:00:00') ){
				
				$slot = date('Y-m-d H:i:s', strtotime($dateTimeValue));
				
				$sql = "insert into appointments(date_time) values ( '".$slot."');";
				$conn->query($sql);
				
				$conn ->commit();
				echo "Your choice of ".$dateTimeValue. " has been saved<br/>";

				
			}
		?>
		</div>
		<footer> 
			<div>
				<a href = "admin_menu.php"> previous </a>
			</div>
		</footer>

	</body>
</html>