<!DOCTYPE html>
<html>
	<head>
		<link rel = "stylesheet" href = "manage_appointments.css">
		
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

		<script>
			var  function ReloadPage(){
				window.location.reload();
			} 
		</script>

		<div id = "content">

		<?php 
			

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

			function decorate($date_time,$notification = "no"){
						$date_time = strtotime($date_time);
						$year = date("Y",$date_time);
						$month = date("M",$date_time);
						$date = date("d",$date_time);
						$day = date("l",$date_time);
						$time = date("h:i:sa",$date_time);
						if($notification == "no"){
							$date_html = "<div class = \"date_time\">" ;
						}
						elseif($notification == "yes"){
							$date_html = "<div class = \"date_time_notify\">" ;
						}
						$date_html = $date_html. "<div class =\"year\">".$year."</div>" ;
						$date_html = $date_html. "<div class =\"month\">".$month."</div>" ;
						$date_html = $date_html. "<div class =\"date\">".$date."</div>" ;
						$date_html = $date_html. "<div class =\"day\">".$day."</div>" ;
						$date_html = $date_html. "<div class =\"time\">".$time."</div>" ;
						$date_html = $date_html."</div>" ;
						return $date_html ;
						
						

						
					}


			function showAvailableSlots($conn){

						//fetching slots that have not being booked i.e. those that have no values for netid field
		    			 $sql = "select * from  appointments  ; ";
								
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {

							echo "<form  method=  \"post\" action = \"manage_appointments.php\" \>";
			    			// output data of each row
			    			echo "<table><caption>Appointment slots </caption> <tr><th></th><th>Student ID </th> <th> Date and Time </th> </tr>";
			    			while($row = $result->fetch_assoc()) {


			    			if( date("Y.m.d",strtotime( $row["date_time"]) )  == date("Y.m.d",strtotime("now") )  and $row['netid'] != ''     ){
			    					
			    					 $date_time_html = decorate($row["date_time"],"yes") ;
			    				} 
			    			else
			    					$date_time_html = decorate($row["date_time"],"no") ;
			       			echo "<tr>"."<td>"."<input type = radio value = '".$row["date_time"]."' name = \"chosen_slot\">"."</td>"."<td>".$row["netid"]."</td>" ."<td>" . $date_time_html. "</td>"."</tr>";
			    			}
			    			echo "</table><br/>";
			    			echo "<input  class = \"buttons\" type = \"submit\" name = \"remove_slot\" value = \"Remove this slot\" \>";
			    			echo "</form><br/>";
		    			}
		    		}

		    		
		    		if(!empty($_POST["remove_slot"])){
	    				
	    				$sql = "delete from  appointments where date_time ='".$_POST["chosen_slot"]."';" ;
	    				$conn -> query($sql) ;
	    				$conn -> commit();
	    				echo "<script> ReloadPage()</script>" ;
	    				


	    			}
	    			showAvailableSlots($conn);

		?>
		</div>
		<ul>
			<li> Among appointments chosen  by students , those that  match today's date are shown in red  </li>
			<li>If you don't see a student ID beside a date, that slot is yet to be booked. You can still, cancel that appointment. </li>
		</ul>
		<footer> 
			<div>
				<a href = "admin_menu.php"> previous </a>
			</div>
		</footer>

	</body>
</html>