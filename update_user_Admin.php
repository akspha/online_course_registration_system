<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "update_user_Admin.css">
		
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
			<h2> Update Student Users </h2>
			<form method = "POST" action = "update_user_Admin.php">
				<fieldset>
					<label>User Name:&nbsp;</label><input type = "text" name = "usr"/><br/>
					<label>Password:&nbsp;</label><input type = "text" name = "pas"/><br/>
					<input class = "buttons" type = "submit" name = "add_user"  value = "Add/Update user"/> &nbsp; 
					<input class = "buttons" type = "submit" name = "delete_user"  value = "Delete user"/>  &nbsp;
					<input class = "buttons" type = "submit" name = "show"  value = "Show Table"/>  &nbsp;
					<input class = "buttons" type = "reset" value = "Clear this form"/><br/>
					<small>Please specifiy both </small><br/><br/>

					<small>If user with given user name doesn't exist,a new entry will be created otherwise, an existing entry will be overwritten. </small>
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
				if(!empty($_POST["add_user"])){

						
						//If user with that user name doesn't exist, inser new row into table, else
						// create a new row
						$sql = "insert into logindetails   values ('".$usr."','".$pas. "');" ;
						$result = $conn->query($sql);

						$sql = "update logindetails set pwd = "."'".$pas."' where uname = '".$usr . "';";
						$result = $conn->query($sql);

						$conn ->commit();
						$conn -> close();
					}

				//Handling Remove button click event
				if(!empty($_POST["delete_user"])){
						
						$sql = "delete from logindetails  where uname = '".$usr."';"  ;//."' and pwd = '".$pas."';";
						$result = $conn->query($sql);
						$conn ->commit();
						$conn -> close();
					}
				//show the table
				if(!empty($_POST["show"])){
					
					$sql = "select * from logindetails  ;";
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
		    			// output data of each row
		    			echo "<table> <caption> Login Credentials </caption><tr><th>User Name </th> <th> Password  </th> </tr>";
		    			while($row = $result->fetch_assoc()) {
		       			echo "<tr>"."<td>" . $row["uname"]. "</td><td>" . $row["pwd"]."</td></tr>";
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