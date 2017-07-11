<!DOCTYPE html>
	<head> 
		<title>Student Profile </title>
		<link rel = "stylesheet" href = "profile_form.css">
	</head>
	<?php session_start();?>
	<body >
		
			<h1 id = "utdWordMark">  The University of Texas at Dallas </h1>
			<header>
			<nav> 
				<ul>
					<li> <a href = "cs_degree_track2.html"> Computer Science Degree Track </a> </li>
					<li>&nbsp;</li>
					<li> <a href = "acknowledgement_of_policies.php"> Acknowledgement of Policies </a> </li>
					<li>&nbsp;</li>
					<li><a href = "profile_form.php">My profile </a></li>
					<li><a href = "select_from_slots.php"> Appointments </a> </li>
					<li id = "loginout"> <a href = "logout_screen.php">logout </a></li>
				</ul>
			</nav>



		</header>
		<div id = "content_vicinity">
		<div id = "content">
			<?php
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
			?>


			<?php

					//Displaying user_personal table
					$sql = "select * from  user_personal where netid = '" .$_SESSION["netid"] .    "' ; ";
							
					$result = $conn->query($sql);
					
					

					
					
					if ($result->num_rows > 0) {
		    			// output data of each row
		    			echo "<table><caption>Personal Details </caption> <tr> <th> First Name </th> <th> Last Name </th> <th> NET-ID </th> <th> E-mail address </th> <th> Phone Number </th> </tr>";
		    			while($row = $result->fetch_assoc()) {
		       			echo "<tr>"."<td>" . ucfirst($row["fname"]). "</td><td>" . ucfirst($row["lname"])."<td>".$row["netid"]."</td>"."<td> <a href ='mailto: ".$row["email"]."'>".$row["email"] ." </a></td>"."<td>".$row["phone"]."</td>". "</td></tr>";
		    			}
		    			echo "</table><br/>";
	    			}

					
	    			//Displaying user_academic table
					$sql = "select dd.name,d.track_name,u.admission_date,u.graduation_date from user_academic as u join degree_plan as d on u.track_id = d.track_id join department as dd on d.dept_id = dd.id where u.netid = '".$_SESSION["netid"]. "';";		
					$result = $conn->query($sql);
					
					

					
					
					if ($result->num_rows > 0) {
		    			// output data of each row
		    			echo "<table><caption>Adademic Details </caption> <tr> <th> Major </th> <th> Track </th> <th> Date admitted </th> <th> Expected date of graduation </th>  </tr>";
		    			while($row = $result->fetch_assoc()) {
		       			echo "<tr>"."<td>" . ucfirst($row["name"]). "</td><td>" . ucfirst($row["track_name"])."<td>".$row["admission_date"]."</td>"."<td>".$row["graduation_date"]."</td>" ."</tr>";
		    			}
		    			echo "</table><br/>";
	    			}


	    			function get_course_num($prefix){

						  preg_match_all("/\d+/", $prefix, $matches);

	    				 return $matches[0][0];

	    		    }

	    		    function get_course_from_checkboxes($courses,$conn, $add_drop){
		    		    	if(isset($courses)){
		    		    		
			    			//Inserting data in user_classes table
			    			if(count($courses) >0){
			    				
			    				foreach ($courses as $key => $value) {
			    				  	
			    				  	$course_details = explode(",", $value);
			    				  	//echo $value. "<hr/><br/>" ;

			    				  	//get corresponding details from courses table

			    				  	$sql = "select prefix,courseid,coursename,credits from courses where courseid = '".intval($value)."' ;" ;
			    				  	$result = $conn -> query($sql) ;
			    				  	$course_details = $result -> fetch_assoc() ;//only one row should be returned


			    				  	//place the so obtained details in registered courses table
			    				  	if($add_drop == "Add"){
				    				  	$sql = "insert into registered_courses values('".$_SESSION["netid"]."','".$course_details["prefix"]."','".($course_details["courseid"])."','".$course_details["coursename"]."','".intval($course_details["credits"])."');";
										$conn->query($sql);
										$conn -> commit(); 
									}
									if ($add_drop == "Drop"){
										
										$sql = "delete from  approved_courses where netid = '".$_SESSION["netid"]."' and courseid = '".intval($course_details["courseid"])."';";
										$conn->query($sql);
										$conn -> commit(); 
										$sql = "delete from  registered_courses where netid = '".$_SESSION["netid"]."' and courseid = '".intval($course_details["courseid"])."';";
										$conn->query($sql);
										$conn -> commit(); 

									}
			    				  	
			    				  	//echo "</tr>";
			    				  	
			    				}
			    				//echo "</table>";
			    			}
			    			echo "<br/>";
			    		}
		    		

		    		   }
	    		    
	    		    //Extracting data from the checkboxes of courses

		    		//Adding courses
	    		   if(!empty($_POST["submit_elective_add"]) ||!empty($_POST["submit_core_add"])) {
		    		    

		    		   if(isset($_POST["core_courses"]) ){

			    		   		
				    		   get_course_from_checkboxes($_POST["core_courses"],$conn,$_POST["submit_core_add"] ) ;
									
							   
						}

						if(isset($_POST["elective_courses"]) ){

			    		   		
				    		   get_course_from_checkboxes($_POST["elective_courses"],$conn, $_POST["submit_elective_add"] ) ;
									
							   
						}
					}


					//Drop courses
					if(!empty($_POST["submit_elective_drop"]) ||!empty($_POST["submit_core_drop"])) {
		    		    

		    		   if(isset($_POST["core_courses"]) ){

			    		   		
				    		   get_course_from_checkboxes($_POST["core_courses"],$conn,$_POST["submit_core_drop"]) ;
									
							   
						}

						if(isset($_POST["elective_courses"]) ){

			    		   		
				    		   get_course_from_checkboxes($_POST["elective_courses"],$conn,$_POST["submit_elective_drop"]) ;
									
							   
						}
					}

		 		//Displaying courses_approved
				$sql = "select prefix, coursename,credits,date_of_approval from approved_courses as a join registered_courses  as r on a.netid = r.netid and a.courseid = r.courseid and a.netid ='". $_SESSION['netid']."';";
				$result = $conn->query($sql);
				
				

				
				
				if ($result->num_rows > 0) {
					// output data of each row
					echo "<table><caption>Courses approved </caption> <tr> <th> Course ID </th> <th> Course name </th> <th>credits </th> <th>date of approval </th> </tr>";
					while($row = $result->fetch_assoc()) {
		   			echo "<tr>"."<td>" . ucfirst($row["prefix"]). "</td><td>" . ucfirst($row["coursename"])."<td>".$row["credits"]."</td>"."<td>".$row["date_of_approval"]."</td>" ."</tr>";
					}
					echo "</table><br/>";
				}


				//Displaying courses transferred
				$sql = "select prefix, coursename,credits from transferred_courses as a join registered_courses  as r on a.netid = r.netid and a.courseid = r.courseid and a.courseid = r.courseid and a.netid ='". $_SESSION['netid']."';";	
				$result = $conn->query($sql);
				
				

				
				
				if ($result->num_rows > 0) {
					// output data of each row
					echo "<table><caption>Courses Transferred </caption> <tr> <th> Course ID </th> <th> Course name </th> <th>credits </th> </tr>";
					while($row = $result->fetch_assoc()) {
		   			echo "<tr>"."<td>" . ucfirst($row["prefix"]). "</td><td>" . ucfirst($row["coursename"])."<td>".$row["credits"]."</td>"."</tr>";
					}
					echo "</table><br/>";
				}




				//Displaying courses waived
				$sql = "select prefix, coursename,credits from waived_courses as a join registered_courses  as r on a.netid = r.netid and a.courseid = r.courseid and a.courseid = r.courseid and a.netid ='". $_SESSION['netid']."';";	
				$result = $conn->query($sql);
				
				

				
				
				if ($result->num_rows > 0) {
					// output data of each row
					echo "<table><caption>Courses waived </caption> <tr> <th> Course ID </th> <th> Course name </th> <th>credits </th> </tr>";
					while($row = $result->fetch_assoc()) {
		   			echo "<tr>"."<td>" . ucfirst($row["prefix"]). "</td><td>" . ucfirst($row["coursename"])."<td>".$row["credits"]."</td>" ."</tr>";
					}
					echo "</table><br/>";
				}




				$conn ->commit();
				

		 	
		 	//Display registered courses that have been approved as courses that are being taken currently

		 	//join registered courses with approved courses and show prefix, course name and credits
		 	$sql = "select prefix, coursename, credits from ((registered_courses as r join approved_courses as a on r.netid = a.netid and r.courseid = a.courseid) left join grades as g on  r.netid = g.netid and r.courseid = g.courseid  ) where g.courseid is null and a.courseid = r.courseid and a.netid ='". $_SESSION['netid']."';";
		 
		 	$result = $conn->query($sql);
			
			if ($result->num_rows > 0) {
					// output data of each row
					echo "<table><caption>Currently taking the following courses </caption> <tr> <th> Course ID </th> <th> Course name </th> <th>credits </th> </tr>";
					while($row = $result->fetch_assoc()) {
		   			echo "<tr>"."<td>" . ucfirst($row["prefix"]). "</td><td>" . ucfirst($row["coursename"])."<td>".$row["credits"]."</td>" ."</tr>";
					}
					echo "</table><br/>";
				}




				$conn -> commit();


				//displaying grades

				$sql= "select distinct prefix, coursename, credits,gpa from courses join grades on courses.courseid = grades.courseid  where grades.netid = '".$_SESSION["netid"]."';";
				$result = $conn->query($sql);
			
				if ($result->num_rows > 0) {
					// output data of each row
					echo "<table><caption>You have taken the following courses </caption> <tr> <th> Course ID </th> <th> Course name </th> <th>credits </th> <th>GPA </th> </tr>";
					while($row = $result->fetch_assoc()) {
		   			echo "<tr>"."<td>" . ucfirst($row["prefix"]). "</td><td>" . ucfirst($row["coursename"])."<td>".$row["credits"]."</td>"."<td>".$row["gpa"]."</td>" ."</tr>";
					}
					echo "</table><br/>";

					$sql = "select AVG(gpa) as cgpa from grades;";
				$result = $conn -> query($sql) ;
				$row = $result -> fetch_assoc();
				echo "Your Average GPA is ".$row["cgpa"]."<br/>" ;
				}

				


			


				//Close connection after all transactions have been made
				$conn -> close();
		 	?>

			
			

			<!--<p>Recommended Courses </p>-->

			<hr/>
		</div>
	</div>
	</body>


	<footer> 
			<div>
				<a href = "acknowledgement_of_policies.php"> previous </a> &nbsp; <a href = "cs_degree_track2.html"> next </a>
			</div>
	</footer>

</html>