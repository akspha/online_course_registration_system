<!DOCTYPE html>
<html>
	<head> 
		<link rel = "stylesheet" href = "course_listing.css"/>
		<title>course Listing</title>
	</head>
	<?php session_start();?>
	<body> 
		<header>
			<h1 id = "utdWordMark">  The University of Texas at Dallas </h1>
			<nav> 
				<ul>
					<li> <a href = "cs_degree_track2.html"> Computer Science Degree Track </a> </li>
					<li>&nbsp;</li>
					<li> <a href = "acknowledgement_of_policies.php"> Acknowledgement of Policies </a> </li>
					<li>&nbsp;</li>
					<li><a href = "profile_form.php">My profile </a></li>
					<li id = "loginout"> <a href = "logout_screen.php">logout </a></li>
				</ul>
			</nav>



		</header>
		<div id = "content">
		<?php 
			if( $_SERVER["REQUEST_METHOD"]  == "POST"){
				extract($_POST);
				$names = explode(",",strtolower($name)) ;
				$fname = $names[1];
				$lname = $names[0];
				echo "Welcome ".ucfirst($fname)." ".ucfirst($lname)."<br/>" ;
				$netid = $_SESSION["netid"] ;
				$login_password = $_SESSION["pass"];
				
				//The value of $degree_plan indicates trackid
				
			
				
				$seasonyear  = explode(" ",$firstsemester);

				$year_admission = $seasonyear[1];
				$year_graduation = strval(intval($year_admission)+ 2 );

				$season = $seasonyear[0] ;

				if($season == "Fall"){
					$month_admission = 8;
				}
				else if ($season == "Summer"){
					$month_admission = 5 ;
				}
				else if($season == 1){
					$month_admission=  1 ;
				}


				$date_admission = date('Y-m-d', strtotime(str_replace('-', '/', $year_admission."-".$month_admission."-"."1")));
				$date_graduation  = date('Y-m-d', strtotime(str_replace('-', '/', strval(intval($year_admission+2))."-".$month_admission."-"."1")));
				

				

				
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

				//filling user_personal table
				$sql = "insert into user_personal values ( '".$netid."','".$fname."','".$lname."','".$phone."','".$email. "');";
						
				$conn->query($sql);
				
				//filling user_academic table
				$sql = "insert into user_academic values ( '".$netid."','".$login_password."','".$degreeplan."','".$date_admission."','".$date_graduation. "');";
						
				$conn->query($sql);
				
				$conn ->commit();


    			/*function get_course_prefix($course_listing){

					  preg_match_all("/[a-zA-Z]{2,3} \d+/", $course_listing, $matches);

					  

    				 return $matches[0][0];

    		    }


    			function get_course_num($prefix){

					  preg_match_all("/\d+/", $prefix, $matches);

    				 return $matches[0][0];

    		    }

    		    function get_course_description($course_listing){

					  preg_match_all("/[a-zA-Z]+/", $course_listing, $matches);

    				 return $matches[0][0];

    		    }*/



				//getting prerequisties
				if(!empty( $prerequisites)){
					foreach ($prerequisites as $key => $value) {
						//if value not in waived, insert entry in currently taking/ registered_courses

						
						$sql = "select * from waived_courses where courseid = '".$value ."';";
						$result = $conn ->query($sql);
						$num_rows = $result -> num_rows ;
						echo $num_rows ;
						if ( $num_rows  == 0){
							//course has not been waived
							echo "This course has not been waived and must be done<br/>" ;

							//get details from courses

							$sql = "select prefix, courseid,coursename,credits  from courses where courseid = '".$value ."';";
							$result= $conn ->query($sql);
							if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {

								$prefix = $row["prefix"];
								$courseid = $row["courseid"];
								$coursename = $row["coursename"];
								$credits = $row["credits"];
								echo "You are being registered into $coursename <br/>";
				   				$sql = "insert into registered_courses values ('".$netid."','".$prefix."','".intval($courseid)."','".$coursename."','".$credits."' ) ;";
								
								$conn ->query($sql);

								$today = getdate();
								$date = date('Y-m-d', strtotime(str_replace('/', '-', $today["year"]."-".$today["month"]."-".$today["mday"])));
								$sql = "insert into approved_courses values('".$netid."','".intval($courseid)."','".$date."');" ;
								
								
								$conn -> query($sql);
								$conn ->commit();
								}
							
							}
						}
						
					
					
					}
				}
			}
		?>
		
		<?php
			$sql = "select * from courses where trackid =".$degreeplan
			.";";
			$result = $conn -> query($sql);
			$appeared_courses = array() ;
			if ($result->num_rows > 0) {
				
				// output data of each row
				echo "<form method = \"POST\" action = \"profile_form.php\">";
				echo "<table><caption><h2>Core Courses for your track<h2> </caption> <tr><th></th> <th> Course ID </th> <th> Course name </th> <th>Credits </th> <th>Description</th> </tr>";
				while($row = $result->fetch_assoc()) {
	   			echo "<tr>"."<td>"."<input type = \"checkbox\" name = \"core_courses[]\" value = \" " .$row["courseid"] ."\" />"."</td>"."<td>" . ucfirst($row["prefix"]). "</td><td>" . ucfirst($row["coursename"])."<td>".$row["credits"]."</td>"."<td>".$row["description"]."</td>" ."</tr>";
				$appeared_courses[] = $row["courseid"] ;
				}
				
				echo "</table>";
				echo " <div class = \"button_group\">
	 <input class = \"buttons\" type = \"submit\" name = \"submit_core_add\" value = \"Add\"/>
	  <input class = \"buttons\" type = \"submit\" name = \"submit_core_drop\" value = \"Drop\"/></div> 
</form>";

			}

		
			$sql = "select * from courses where trackid !=".$degreeplan
			.";";
			
			$result = $conn -> query($sql);

			if ($result->num_rows > 0) {
				// output data of each row
				echo "<form method = \"POST\" action = \"profile_form.php\">";
				echo "<table id = \"Electives\"><caption><h2>Elective Courses<h2> </caption> <tr><th></th> <th> Course ID </th> <th> Course name </th> <th>Credits </th> <th>Description</th> </tr>";
				while($row = $result->fetch_assoc()) {
				
					if (!in_array($row["courseid"],$appeared_courses)){
	   					echo "<tr>"."<td>"."<input type = \"checkbox\" name = \"elective_courses[]\" value = \" " .$row["courseid"] ."\" />"."</td>"."<td>" . ucfirst($row["prefix"]). "</td><td>" . ucfirst($row["coursename"])."<td>".$row["credits"]."</td>"."<td>".$row["description"]."</td>" ."</tr>";
					 	$appeared_courses[] = $row["courseid"] ;
					}
				}
				
				echo "</table>";
				echo "<div class = \"button_group\">
	 <input class = \"buttons\" type = \"submit\" name = \"submit_elective_add\" value = \"Add\"/>
	  <input class = \"buttons\" type = \"submit\" name = \"submit_elective_drop\" value = \"Drop\"/> </div>
</form>";

			}

		?>

	</div>
	<br/>
<footer> 
			<div>
				<a href = "acknowledgement_of_policies.php"> previous </a>
			</div>
</footer>

</body>
</html>