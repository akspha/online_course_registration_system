<!DOCTYPE html>
	<head> 
		<title>Student Profile </title>
		<link rel = "stylesheet" href = "profile_form.css">
	</head>
	<?php session_start();?>

	<body>
		<header>
			<h1 id = "utdWordMark">  The University of Texas at Dallas </h1>
			<nav> 
				<ul>
					Welcome
					<li id = "loginout"> <a href = "logout_screen_admin.php">logout </a></li>
				</ul>
			</nav>



		</header>

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
				$names = explode(",",$_POST["name"]);
				$fname = $names[1];
				$lname = $names[0];

				$sql = "select * from  user_personal where netid = '" .$_POST["netid"] .    "' and fname = '".$fname. "' and lname = '". $lname."' ; ";
						
				$result = $conn->query($sql);
				
				$conn ->commit();
				$conn -> close();

				
				
				if ($result->num_rows > 0) {
	    			// output data of each row
	    			echo "<table><caption>Personal Details </caption> <tr> <th> First Name </th> <th> Last Name </th> <th> NET-ID </th> <th> E-mail address </th> <th> Phone Number </th> </tr>";
	    			while($row = $result->fetch_assoc()) {
	       			echo "<tr>"."<td>" . ucfirst($row["fname"]). "</td><td>" . ucfirst($row["lname"])."<td>".$row["netid"]."</td>"."<td> <a href ='mailto: ".$row["email"]."'>".$row["email"] ." </a></td>"."<td>".$row["phone"]."</td>". "</td></tr>";
	    			}
	    			echo "</table>";
    			}
    			else{
    				echo "Please go back and enter the same student's name and net-id<br/>";
    			}



		?>

		
		<hr/>
		<table>
			<caption>Academic Details </caption>
			<tr> 
				<th>Major  </th> 
				<th>Track  </th>
				<th>Admitted  </th>
				<th>Expected to graduate  </th>
			</tr>
			<tr> 
				<td> </td> 
				<td> </td>
				<td> </td>
				<td> </td>
			</tr>

	
		</table>
		<hr/>

		<table>
			<caption>Courses waived or transferred </caption>
			<tr>
				<th>Course number </th>
				<th>Course Name </th>
				<th> Waived </th>
				<th> Transferred </th>
				<th> Date of approval </th>
			</tr>
			<tr> 
				<td> </td> 
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
			</tr>
			
		</table>
		<hr/>

		<table>
			<caption>Courses taken </caption>
			<tr>
				<th>Course number </th>
				<th>Course Name </th>
				<th> Time of taking the course </th>
				<th> Taking now </th>
				<th> Grade </th>
			</tr>
			<tr> 
				<td> </td> 
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
			</tr>

		</table>
		<hr/>

		<table>
			<caption>Grade </caption>
			<tr> 
				<th>Core courses </th> 
				<th>All subjects </th>
				
			</tr>
			<tr> 
				<td> </td> 
				<td> </td>
				
			</tr>

		</table>
		<hr/>
		<p>Recommended Course </p>
		<hr/>
	</body>

	<footer> 
			<div>
				<a href = "course_listing_Admin.html"> previous </a>
			</div>
	</footer>

</html>