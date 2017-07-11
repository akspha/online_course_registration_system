<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "update_degree_Admin.css">
		
	</head>
	<?php session_start();?>
	<body>
		<header>
			<h1 id = "utdWordMark">  The University of Texas at Dallas </h1>
			<nav> 
				<ul>
					
					<li> <a href = "approve_courses.php"> Approvals,Transfers&Waivers </a> </li>
					<li>&nbsp;</li>
					<li> <a href = "update_courses.php">  Add/Remove courses </a> </li>
					<li>&nbsp;</li>
					<li> <a href = "update_grades_Admin.php"> Add grades</a> </li>
					<li>&nbsp;</li>
					<li><a href = "update_degree_Admin.php"> Add/Remove Degree Plan </a></li>
					<li><a href = "update_user_Admin.php"> Add/Remove User </a> </li>
					<li><a href = "set_appointment_time_admin.php" >Appointment times</a></li>
					<li><a href = "manage_appointments.php" > Manage appointments</a></li>
					<li id = "loginout"> <a href = "logout_screen.php">logout </a></li>
				</ul>
			</nav>
		
		<hr/>
		</header>
		<div id = "content">
	        <h2> Tables for reference</h2>

	        <table>
	        	<caption> Departments </caption>
	        	<tr> <th>Department Name </th> <th>Department ID </th> </tr>
	        	<tr> <td>Computer Science </td> <td>  1 </td> </tr>
	        	<tr> <td>Electrical  </td> <td>  2 </td> </tr>

	        </table>



	        <table>
	        	<caption>Degrees </caption>
	        	<tr> <th> Degree Name</th> <th> Degree ID </th> </tr>
	        	<tr> <td> Master of Science</td>  <td> 1 </td> </tr>
	        	<tr> <td> Doctorate in Philosophy</td>  <td> 2 </td> </tr>
	        	<tr><td> Bachelor of Science</td>  <td> 3 </td>  </tr>

	        </table>

	        <br/>
	        <h2> Update Tracks </h2>
			<form method = "POST" action = "update_degree_Admin.php">
				<fieldset>
					<label>Track id:&nbsp;</label><input type = "text" name = "track_id"/><br/>
					<label>Degree id:&nbsp;</label><input type = "text" name = "degree_id"/><br/>
					<label>Department id:&nbsp;</label><input type = "text" name = "dept_id"/><br/>
					<label>Degree Name:&nbsp;</label><input type = "text" name = "degree_name"/><br/>
					<label>Track Name:&nbsp;</label><input type = "text" name = "track_name"/><br/>
					<input class = "buttons" type = "submit" name = "add_degrees_submission"  value = "Add"/> &nbsp; 
					<input class = "buttons" type = "submit" name = "remove_degrees_submission"  value = "Remove"/>  &nbsp;
					<input class = "buttons" type = "submit" name = "show_degrees_submission"  value = "Show Table"/>  &nbsp;
					<input class = "buttons" type = "reset" value = "Clear this form"/><br/>
					<small>Please specifiy all three IDs </small>
				</fieldset>
			</form>

			<?php
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

				//Handling Add button click event
				if(!empty($_POST["add_degrees_submission"])){
						
						$sql = "insert into degree_plan   values ('".$track_id."','".$degree_id."','".$dept_id."','".$degree_name."','".$track_name  .  "');" ;


						$result = $conn->query($sql);
						$conn ->commit();
						$conn -> close();
					}

				//Handling Remove button click event
				if(!empty($_POST["remove_degrees_submission"])){
						
						$sql = "delete from degree_plan  where track_id = '".$track_id."' and degree_id = '".$degree_id."' and dept_id = '".$dept_id  ."';";
						$result = $conn->query($sql);
						$conn ->commit();
						$conn -> close();
					}
				//show the table
				if(!empty($_POST["show_degrees_submission"])){
					
					$sql = "select * from degree_plan  ;";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
		    			// output data of each row
		    			echo "<table><caption>Degree Plan </caption> <tr> <th> Track ID </th> <th> Degree ID </th> <th> Department ID </th> <th> Degree Name </th> <th>Track Name</th> </tr>";
		    			while($row = $result->fetch_assoc()) {
		       			echo "<tr>"."<td>" . ucfirst($row["track_id"]). "</td><td>" . ucfirst($row["degree_id"])."<td>".$row["dept_id"]."</td>"."<td>".$row["degree_name"]."</td>"."<td>".$row["track_name"]."</td>". "</td></tr>";
		    			}
		    			echo "</table>";
	    			}

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