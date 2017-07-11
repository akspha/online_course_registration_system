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

			<h2> Update course status for students </h2>


			<form method = "POST" action = "approve_courses.php">
				<fieldset>
					<label>User NET-ID :&nbsp;</label><input type = "text" name = "netid"/><br/>
					<label>Course-ID:&nbsp;</label><input type = "text" name = "courseid"/><br/>

					<table>
						<tr> <td><input class = "buttons" type = "submit" name = "approve"  value = "Approve Course"/> </td>
							<td><input class = "buttons" type = "submit" name = "disapproval"  value = "Rescind Approval"/> </td>
						</tr>

						<tr>
						<td> <input class = "buttons" type = "submit" name = "waive"  value = "Waive Course"/>  </td>
						<td>  <input class = "buttons" type = "submit" name = "nowaiver"  value = "Rescind waiver"/> </td>
						</tr>
						
						<tr>
						<td><input class = "buttons" type = "submit" name = "transfer"  value = "Transfer Course"/></td>
						<td><input class = "buttons" type = "submit" name = "notransfer"  value = "Rescind transfer"/>  </td>
					   </tr>

					</table>

					<input class = "buttons"  type = "reset" value = "Clear this form"/><br/>
					

					<small>Please specify both student and course IDs</small>
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

				//Handling approve button click event
				if(!empty($approve)){

						
						//If user with that user name doesn't exist, insert new row into table, else
						// create a new row
						$today = getdate();
						
						$date = date('Y-m-d', strtotime(str_replace('/', '-', $today["year"]."-".$today["month"]."-".$today["mday"])));
						
						$sql = "insert into approved_courses   values ('".$netid."','".$courseid."','".$date ."');" ;
						$result = $conn->query($sql);

						$sql = "select coursename from registered_courses where netid = '".$netid."' and courseid = '".$courseid."';";
						$query_for_coursename = $conn->query($sql);


						$sql = "select fname,lname from user_personal where netid = '".$netid."';";
						$query_for_name = $conn->query($sql);

						if ($query_for_coursename->num_rows > 0 and $query_for_name->num_rows > 0 ) {

		    				echo "The course ";
		    				$row_coursename = $query_for_coursename->fetch_assoc() ;

		    				echo $row_coursename["coursename"];

		    				$row_name = $query_for_name->fetch_assoc() ;
		    				
			       			echo " has been approved for ";  echo ucfirst($row_name["fname"])." ".ucfirst($row_name["lname"]);
			       			echo  "<br/>" ;
		    			
	    				}
	    				else{
	    					echo "Either the course or the student is not registered. Please enter details again if, they were put incorrectly<br/>";
	    				}

						$conn ->commit();
						$conn -> close();
					}

				
				////Handling rescind approve button click event
				if(!empty($disapproval)){


					$sql = "delete from approved_courses where   netid = '".$netid."' and courseid = '".intval($courseid). "';" ;
					$result = $conn->query($sql);
					$conn ->commit();
					//echo $sql. " <br/>" ;

					$sql = "delete from registered_courses where   netid = '".$netid."' and courseid = '".intval($courseid). "';" ;
					$result = $conn->query($sql);
					$conn ->commit();
					//echo $sql. " <br/>" ;

					echo "The specified course has been rescinded for the given student <br/>" ;




					

					/*$sql = "select coursename from registered_courses where netid = '".$netid."' and courseid = '".$courseid."';";
					$query_for_coursename = $conn->query($sql);

					$sql = "select fname,lname from user_personal where netid = '".$netid."';";
					$query_for_name = $conn->query($sql);

					if ($query_for_coursename->num_rows > 0 and $query_for_name->num_rows > 0 ) {

	    				echo "The course ";
	    				$row_coursename = $query_for_coursename->fetch_assoc() ;

	    				echo $row_coursename["coursename"];

	    				$row_name = $query_for_name->fetch_assoc() ;
	    				
		       			echo " has been dis-allowed for ";  echo ucfirst($row_name["fname"])." ".ucfirst($row_name["lname"]);
		       			echo  "<br/>" ;
	    			
					}
					else{
						echo "Either the course or the student is not registered. Please enter details again if, they were put incorrectly<br/>";
					}
					*/
					
					$conn -> close();

				}



				//Handling waive button click event
				if(!empty($waive)){

						
						//If user with that user name doesn't exist, inser new row into table, else
						// create a new row
						$sql = "insert into waived_courses   values ('".$netid."','".$courseid. "');" ;
						$result = $conn->query($sql);

						$sql = "select coursename from registered_courses where netid = '".$netid."' and courseid = '".$courseid."';";
						$query_for_coursename = $conn->query($sql);


						$sql = "select fname,lname from user_personal where netid = '".$netid."';";
						$query_for_name = $conn->query($sql);

						if ($query_for_coursename->num_rows > 0 and $query_for_name->num_rows > 0 ) {

		    				echo "The course ";
		    				$row_coursename = $query_for_coursename->fetch_assoc() ;

		    				echo $row_coursename["coursename"];

		    				$row_name = $query_for_name->fetch_assoc() ;
		    				
			       			echo " has been waived for ";  echo ucfirst($row_name["fname"])." ".ucfirst($row_name["lname"]);
			       			echo  "<br/>" ;
		    			
	    				}
	    				else{
	    					echo "Either the course or the student is not registered. Please enter details again if, they were put incorrectly<br/>";
	    				}

						$conn ->commit();
						$conn -> close();
					}

				
				////Handling rescind waiver button click event
				if(!empty($nowaiver)){

					$sql = "delete from waived_courses where   netid = '".$netid."' and courseid = '".$courseid. "';" ;
					$result = $conn->query($sql);

					$sql = "select coursename from registered_courses where netid = '".$netid."' and courseid = '".$courseid."';";
					$query_for_coursename = $conn->query($sql);


					$sql = "select fname,lname from user_personal where netid = '".$netid."';";
					$query_for_name = $conn->query($sql);

					if ($query_for_coursename->num_rows > 0 and $query_for_name->num_rows > 0 ) {

	    				echo "Waiver for the course ";
	    				$row_coursename = $query_for_coursename->fetch_assoc() ;

	    				echo $row_coursename["coursename"];

	    				$row_name = $query_for_name->fetch_assoc() ;
	    				
		       			echo " has been rescinded for ";  echo ucfirst($row_name["fname"])." ".ucfirst($row_name["lname"]);
		       			echo  "<br/>" ;
	    			
					}
					else{
						echo "Either the course or the student is not registered. Please enter details again if, they were put incorrectly<br/>";
					}

					$conn ->commit();
					$conn -> close();

				}


				//Handling transfer button click event
				if(!empty($transfer)){

						
						//If user with that user name doesn't exist, inser new row into table, else
						// create a new row
						$sql = "insert into transferred_courses   values ('".$netid."','".$courseid. "');" ;
						$result = $conn->query($sql);

						$sql = "select coursename from registered_courses where netid = '".$netid."' and courseid = '".$courseid."';";
						$query_for_coursename = $conn->query($sql);


						$sql = "select fname,lname from user_personal where netid = '".$netid."';";
						$query_for_name = $conn->query($sql);

						if ($query_for_coursename->num_rows > 0 and $query_for_name->num_rows > 0 ) {

		    				echo "The course ";
		    				$row_coursename = $query_for_coursename->fetch_assoc() ;

		    				echo $row_coursename["coursename"];

		    				$row_name = $query_for_name->fetch_assoc() ;
		    				
			       			echo " has been transferred for ";  echo ucfirst($row_name["fname"])." ".ucfirst($row_name["lname"]);
			       			echo  "<br/>" ;
		    			
	    				}
	    				else{
	    					echo "Either the course or the student is not registered. Please enter details again if, they were put incorrectly<br/>";
	    				}

						$conn ->commit();
						$conn -> close();
					}

				
				////Handling rescind transfer button click event
				if(!empty($notransfer)){

					$sql = "delete from transferred_courses where   netid = '".$netid."' and courseid = '".$courseid. "';" ;
					$result = $conn->query($sql);

					$sql = "select coursename from registered_courses where netid = '".$netid."' and courseid = '".$courseid."';";
					$query_for_coursename = $conn->query($sql);


					$sql = "select fname,lname from user_personal where netid = '".$netid."';";
					$query_for_name = $conn->query($sql);

					if ($query_for_coursename->num_rows > 0 and $query_for_name->num_rows > 0 ) {

	    				echo "Transfer request for the course ";
	    				$row_coursename = $query_for_coursename->fetch_assoc() ;

	    				echo $row_coursename["coursename"];

	    				$row_name = $query_for_name->fetch_assoc() ;
	    				
		       			echo " has been rescinded for ";  echo ucfirst($row_name["fname"])." ".ucfirst($row_name["lname"]);
		       			echo  "<br/>" ;
	    			
					}
					else{
						echo "Either the course or the student is not registered. Please enter details again if, they were put incorrectly<br/>";
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