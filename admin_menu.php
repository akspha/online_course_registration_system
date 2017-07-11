<!DOCTYPE html>
<html>
	<head>
		<title> Main Menu </title>
		<link rel = "stylesheet" href = "login_main_menu.css">
	</head>
	<?php session_start();?>
	<script> 
	function ChangeLoginToLogout(){
		//This function changes the word Logout at the right hand corner of the navigation bar
		//to login when user tries to login with invalid details
		document.getElementById("loginout").innerHTML = ' <a href = "login_screen.html"> login</a>';
	}
	</script>

	<body>
		<header>
			<h1 id = "utdWordMark">  The University of Texas at Dallas </h1>
			<nav> 
				<ul>
					Choose from one of the  options
					<li id = "loginout"> <a href = "logout_screen_admin.php">logout </a></li>
				</ul>

				
			</nav>
		</header>

		<?php
			

			$error = "";
			if($_SERVER["REQUEST_METHOD"] == "POST"){
				if( isset($_POST["netid"]) && isset($_POST["pass"]) ){


						//if any one of username or password is empty, prompt the user

						//to put both

						if($_POST["netid"] == "" || $_POST["pass"] == ""){

							echo "<script> ChangeLoginToLogout();</script> " ;

							die( "Please enter both username and password<br/>" ); 
						}

						//retreive rows from the table with columns
						//for username and password
						$uname = $_POST["netid"] ;
						
						$pwd = $_POST["pass"];
									//establishing a connection to database
						$servername = "localhost";
						$username = "akspha";
						$password = "akspha";
						$dbname = "mydatabase";

						// Create connection
						$conn = new mysqli($servername, $username, $password,$dbname);
						// Check connection
						if ($conn->connect_error) {
							echo "<script> ChangeLoginToLogout();</script> " ;

						    die("Connection failed: ".$conn->connect_error);
						} 

						$netid = $_POST["netid"];
						$pass = $_POST["pass"];

						$sql = "select * from logindetails_admin where uname = '$netid' and pwd = '$pass';";
						
						$result = $conn->query($sql);

						//if no rows are retrieved, the given combination 
						//of username and password do not exist in the database
						///prompt an error suggesting so

						if(($result->num_rows) == 0){
							echo "<script> ChangeLoginToLogout();</script> " ;

							$error = "Invalid user name or password<br/>" ;
							die( $error) ;

						}
						else{

						//if more than 0 rows are retrieved, load another page
						//or provide link to another page
						//or just display a welcome message
							echo "Welcome <br/>";
							if(!isset($_SESSION)) 
						    { 
						        session_start(); 
						    }
							$_SESSION['netid'] = $uname;
        					$_SESSION['pass'] = $pwd;
        					$cookie_name = "last_login_time_admin";

							if(!isset($_COOKIE[$cookie_name])) {
							    
							} else {
							   
							    echo "You were logged in on: " . $_COOKIE[$cookie_name]."<br/>";
							}
        					
										
						}

					}
					else{
						echo "<script> ChangeLoginToLogout();</script> " ;

						die( "Please enter username and password<br/>");
					}
			}  
		


		
		?>

		<div id = "menu">
			<table>
				<caption> <h1> Main Menu </h1></caption>

				<tbody> 
					<tr>
						<td> <a href = "approve_courses.php" ><img src = "approve.png" height = "100" width = "100"/> Approve/Rescind courses or transfer/waiver for a student </a> </td>
						
						<td> <a href = "set_appointment_time_admin.php" ><img src = "appointment.png" height = "100" width = "100"/> Indicate availibility for appointments </a> </td>
					
					</tr>

					<tr>
						<td> <a href = "update_degree_Admin.php" ><img src = "degree_plan.png" height = "100" width = "100"/> Update Degree Plans</a> </td>
						<td> <a href = "update_courses.php" ><img src = "add_remove_courses.png" height = "100" width = "100"/> Add/ Remove courses </a> </td>

					</tr>

					<tr>
						<td> <a href = "update_user_Admin.php" ><img src = "user_credentials.png" height = "100" width = "100"/> Update user credentials</a> </td>
						<td> <a href = "update_grades_Admin.php" ><img src = "grades.png" height = "100" width = "100"/> Update grades of a student</a> </td>

					</tr>

					<tr>
					<td> <a href = "manage_appointments.php" ><img src = "manage_appointments.png" height = "100" width = "100"/> Manage Appointments </a> </td>

					</tr>

				</tbody>


			</table>

		</div>
		<br/>
		<footer>
			<small>&copy course registration system</small>
		</footer>
	</body>
</html>