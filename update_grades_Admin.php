<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "update_grades_Admin.css">
		
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
			<h2> Update Grades for a student </h2>


			<form method = "POST" action = "update_grades_Admin.php" id = "courses_form">
				<fieldset>
					
					<label>Student ID:&nbsp;</label><input type = "text" name = "netid"/><br/>
					<label>Course ID:&nbsp;</label><input type = "text" name = "prefix"/><br/>
					<label>GPA:&nbsp;</label><input type = "text" name = "gpa"/><br/>
					<input class = "buttons" type = "submit" name = "Update"  value = "Update the course grade"/> 
					<input class = "buttons" type = "reset" value = "Clear this form"/><br/>

					
					

					<small>Please specify course and student IDs</small><br/>
					<small>Unless course corresponding to the course-ID is approved, any update to GPA will not be applied</small>
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
				


				//Handling update button click event
				if(!empty($Update)){
					$courseid = intval(get_course_num($prefix));

					$sql = "update grades set gpa = '".$gpa."' where netid = '".$netid."' and courseid = '".$courseid."';";
					$conn ->query($sql);
					$conn ->commit();


					$sql = "select fname, lname from user_personal where netid = '".$netid."';";
					$result_student_name = $conn->query($sql);

					$sql = "select coursename from courses where courseid = '".$courseid."';";
					$result_course_name = $conn->query($sql);


					$sql = "select * from grades where netid = '".$netid."' and courseid = '".$courseid."';";
					$result_of_update = $conn ->query($sql);

					if($result_of_update-> num_rows > 0){

						if ($result_student_name->num_rows > 0  && $result_course_name->num_rows > 0) {
						$row1 = $result_student_name->fetch_assoc() ;
						$row2 = $result_course_name->fetch_assoc() ;
						echo ucfirst($row1["fname"])." ".ucfirst($row1["lname"])."'s  GPA  for  the course titled ".$row2["coursename"]. " i.e. ".$courseid." has been updated to ".$gpa. " <br/>" ;
						}

					}
					else{

						$sql = "select * from approved_courses where netid = '".$netid."' and courseid = '".$courseid."';" ;
						$result_rows_from_approved = $conn->query($sql);
						if($result_rows_from_approved -> num_rows > 0){

							echo "There was no entry for ".$courseid." so, it is being created<br/>";

							$sql = "insert into  grades values  ('".$netid."','".$courseid."','".$gpa."');" ;
							$conn->query($sql);
							$conn ->commit();
							if ($result_student_name->num_rows > 0  && $result_course_name->num_rows > 0) {
							$row1 = $result_student_name->fetch_assoc() ;
							$row2 = $result_course_name->fetch_assoc() ;
							echo ucfirst($row1["fname"])." ".ucfirst($row1["lname"])." has been granted a GPA of ".$gpa." in the course titled ".$row2["coursename"]. " i.e. ".$courseid. "<br/>" ;
							}
						}
						else{
							echo "The course for which your are attempting to enter grade, is not approved. Grades can only be entered for approved courses. <br/>";
						}

					}
					
					

				}
					
					$conn -> close();

			?>
		</div>
		<br/>
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