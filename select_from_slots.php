<!DOCTYPE html>
<html>
	<head> 
		<link rel = "stylesheet" href = "select_from_slots.css"/>
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
					<li><a href = "select_from_slots.php"> Appointments </a> </li>
					<li id = "loginout"> <a href = "logout_screen.php">logout </a></li>
				</ul>
			</nav>



		</header>
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
			<script>
			var  function ReloadPage(){
				window.location.reload(true);
				
			} 
			</script>

			<?php
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
						else{
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
		    			 $sql = "select date_time from  appointments where  netid = '' ; ";
								
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {

							echo "<form  method=  \"post\" action = \"select_from_slots.php\" \>";
			    			// output data of each row
			    			echo "<table><caption>Available appointment slots </caption> <tr> <th colspan = '2'> Date and Time </th> </tr>";
			    			while($row = $result->fetch_assoc()) {
			       			echo "<tr>"."<td>"."<input type = radio value = '".$row["date_time"]."' name = \"chosen_slot\">"."</td>" ."<td>" . decorate($row["date_time"]). "</td>"."</tr>";
			    			}
			    			echo "</table>";
			    			echo "<input  class = \"buttons\" type = \"submit\" name = \"slot_submission_button\" value = \"Book this slot\" \>";
			    			echo "</form>";
		    			}
	    			


					}

	    			
	    			if(!empty($_POST["slot_submission_button"])){
	    				//echo $_SESSION["netid"]." chose ".$_POST["chosen_slot"]."<br/>";
	    				$sql = "update  appointments set netid = '".$_SESSION["netid"]."' where date_time = '".$_POST["chosen_slot"]."';" ;
	    				$conn -> query($sql) ;

	    				$conn -> commit();
	    				
	    				//unset($_POST["slot_submission_button"]) ;
	    				//echo "NET ID updated<br/>";
	    				echo "<script>ReloadPage();</script>" ;

	    			}

	    			

	    			function showChosenSlots($conn){
	    				
		    		//Displaying appoinments table
						$sql = "select date_time from  appointments where netid = '" .$_SESSION["netid"] .    "' ; ";
								
						$result = $conn->query($sql);
						
						

						
						if ($result->num_rows > 0) {
			    			// output data of each row
			    			echo "<form  action = \"select_from_slots.php\" method = \"post\">";
			    			echo "<table><caption>Your appointments </caption> <tr> <th colspan = '2'> Date and Time </th> </tr>";
			    			while($row = $result->fetch_assoc()) {

			    				if( 
			    					date("Y.m.d",strtotime( $row["date_time"]) )  == date("Y.m.d",strtotime("now") )  ){
			    					
			    					 $date_time_html = decorate($row["date_time"],"yes") ;
			    				} 
			    				else
			    					$date_time_html = decorate($row["date_time"],"no") ;

			       			echo "<td><input type = 'radio' name = 'slot_to_be_deleted' value = '".$row["date_time"]."' /></td>"."<td>" .$date_time_html. "</td></tr>";
			    			}
			    			echo "</table>";
			    			echo "<input   class = \"buttons\" type = \"submit\" name = \"cancel_appointment_button\" value = 'Cancel Appointment ' \>";
			    			echo "</form>";
		    			}

	    			}

	    			
	    			if(!empty($_POST["cancel_appointment_button"])){
	    				//echo $_SESSION["netid"]." chose ".$_POST["slot_to_be_deleted"]." to be deleted <br/>";
	    				//$sql = "delete from  appointments where netid = '".$_SESSION["netid"]."' and date_time ='".$_POST["slot_to_be_deleted"]."';" ;
	    				//$conn -> query($sql) ;
	    				$sql = "update  appointments set netid = '' where date_time = '".$_POST["slot_to_be_deleted"]."';" ;
	    				$conn -> query($sql) ;
	    				$conn -> commit();
	    				
	    				//unset($_POST["cancel_appointment_button"]) ;
	    				
	    				echo "<script>ReloadPage();</script>" ;
	    				
	    				


	    			}

	    			

	    				
		    		showAvailableSlots($conn);
		    		echo "<br/><br/>";

		    		showChosenSlots($conn) ;
		    		
		    		
	    			


	    	?>

		</div>
		<br/>
		<p>NOTES:
			<ul>
				<li>Appointments that match today's date are shown in red </li>
				<li>Times shown here are beginings of slots and each slot can last no longer than 30 minutes </li>
				<li>If you do not see a previously scheduled appointment, then, it has been cancelled by the advisor.In that case, please book another one from available slots.</p>
				</li>
			</ul>
		<footer> 
			<div>
				<a href = "login_main_menu.php"> previous </a>
			</div>
		</footer>

	</body>
</html>