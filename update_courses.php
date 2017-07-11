<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "approve_courses.css">
		
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

		<div id = "content">

			<h2> Update course information </h2>


			<form method = "POST" action = "update_courses.php" id = "courses_form">
				<fieldset>
					
					<label>Course Prefix:&nbsp;</label><input type = "text" name = "prefix"/><br/>
					<label>Course Name:&nbsp;</label><input type = "text" name = "name"/><br/>
					<label>Credits:&nbsp;</label><input type = "text" name = "credits"/><br/>
					<label>Track ID:&nbsp;</label><input type = "text" name = "trackid"/><br/>
					<label>Description:&nbsp;</label> <textarea name="description" form="courses_form"></textarea>
					
					<table>
						<tr> <td><input class = "buttons" type = "submit" name = "Add"  value = "Add the course"/> </td>
							<td><input class = "buttons" type = "submit" name = "Remove"  value = "Remove the course"/> </td>
							 <!-- <td><input type = "submit" name = "Update"  value = "Update Information"/> </td> -->
						</tr>


					</table>

					<input class = "buttons" type = "reset" value = "Clear this form"/><br/>
					

					<small>Please specify course IDs</small>
				</fieldset>
			</form>
			

			<?php
				function get_course_num($s){

						  preg_match_all("/\d+/", $s, $matches);

	    				 return $matches[0][0];

	    		    }


				//establishing a connection to database		
				$servername = "localhost";
				$username = "akspha";
				$password = "akspha";
				$dbname = "mydatabase";
				$error = "" ;
				extract($_POST);
				// Create connection
				$conn = new mysqli($servername, $username, $password,$dbname);
				// Check connection
				if ($conn->connect_error) {
				    die("Connection failed: " . $conn->connect_error);
				}

				//Handling add button click event
				if(!empty($Add)){
					
					$courseid = intval(get_course_num($prefix));
					
					
					
		    		$sql = "insert into  courses values  ('".$courseid."','".$name."','".$prefix."','".intval($credits)."',\"".$description."\",'".intval($trackid)."');" ;
		    		
					
					$result = $conn->query($sql);
					
					echo $name. " has been saved<br\>";
					$conn ->commit();
					$conn -> close();

					 
	    		}

	    		//Handling remove button click event
				if(!empty($Remove)){
					echo "The course with ID ";
					$courseid = intval(get_course_num($prefix));
		    		$sql = "delete from courses where courseid =  '".$courseid."' and trackid = $trackid;" ;
					$result = $conn->query($sql);
					echo $courseid. " has been removed<br\>";
					$conn ->commit();
					$conn -> close();

					 
	    		}

	    				
				
			?>
		</div>
		<br/>
		<br/>
		<br/>
		<br/>
		<footer> 
			<div>
				<a href = "admin_menu.php"> previous </a>
			</div>
		</footer>

	</body>
</html>