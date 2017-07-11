<!DOCTYPE html>
<html>
	<head> 
			<title> Policies Form </title>
			<link rel = "stylesheet" href = "acknowledgement_of_policies.css"/>
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

				<h2>Graduate Computer Science Department
					The University of Texas at Dallas </h2>
			<h3>Master&#39; s  Acknowledgment of Policies Form </h3>

	 	</header>

	 	<script>

	 		function signatures_and_policies(){
	 			
	 			var adv_sig = document.getElementById("graduate_advisor_signature_input") ;
	 			var student_sig = document.getElementById("student_signature_input") ;

	 			var policies =  document.getElementsByName("policy");
	 			var policies_checked = true ;
	 			for (var i = policies.length - 1; i >= 0; i--) {
	 				policies_checked = policies_checked && policies[i].checked ;
	 			}
	 			
	 			if( !(adv_sig.checked && student_sig.checked && policies_checked)){
	 				alert("Please sign  by checking the last checkboxes and the acknowledge  policies by ticking all policies ");
	 				return false;

	 			} 
	 			return true;


	 		}

	 	</script>
	 	<div  id = "content">
	 	<p id = "condition"> **All students must read, complete, sign, and date this form upon entrance to the Graduate CS Department** </p>

	 	<form method = "POST" action = "course_listing2.php"  onsubmit = "return signatures_and_policies()">

	 		<fieldset>
	 			<label> Name (Last, First): &nbsp </label> <input type  = "text" pattern = "[a-zA-Z]+,[a-zA-Z]+"  name = "name"/>

	 			<br/>

	 			<label> UTD ID: &nbsp </label> <input type  = "text" pattern = "20212[0-9][0-9][0-9][0-9][0-9]" name = "utdid"/>

	 			<br/>

	 			<label> First semester in the graduate program:&nbsp</label> <input type = "text" name = "firstsemester"/>

	 			<br/>

	 			<label> E-mail:&nbsp</label> <input type = "text" name = "email" pattern = "[a-z0-9]+@[a-z]+\.(?:com|edu)" />

	 			<br/>

	 			<label> Phone:&nbsp</label> <input type = "text" name = "phone" pattern = "[0-9]{10}" />

	 			<br/>

	 			<label>Degree Plan:&nbsp</label> <br/>
	 			<input type = "radio" name = "degreeplan" value = "1"/> Traditional CS <br/>
	 			<input type = "radio" name = "degreeplan" value = "2"/> Intelligent Systems <br/>
	 			<input type = "radio" name = "degreeplan" value = "3"/> Software Engineering<br/>
	 			<input type = "radio" name = "degreeplan" value = "4"/> Data Science<br/>
	 			<input type = "radio" name = "degreeplan" value = "5"/>Networks and Telecommunications<br/>
	 			<input type = "radio" name = "degreeplan" value = "6"/> Sytems<br/>
	 			<input type = "radio" name = "degreeplan" value = "7"/> Information Assurance<br/>
	 			<input type = "radio" name = "degreeplan" value = "8"/> Interactive Computing <br/>

	 			<br/>

	 			<label>Prerequisites I was assigned in my admission letter/ e-mail (check all that apply)</label>
	 			<br/>

	 			<input type = "checkbox" name = "prerequisites[]" value = "5303"> CS 5303 Computer Science I <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "5330">CS 5330 Computer Science II <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "5333">CS 5333 Discrete Structures <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "5343">CS 5343 Data Structures <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "5348">CS 5348 Operating Systems <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "5349">CS 5349 Automata Theory <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "5354">CS 5354 Software Engineering <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "5390">CS 5390 Computer Networks <br/>
	 			<input type = "checkbox" name = "prerequisites[]" value = "3341">CS 3341 Probability and Statistics <br/>


	 			<p>
	 			By initialing each item below, I indicate that I understand the following policies of The University of Texas at Dallas and the Graduate Computer Science Department:
	 			</p>

				<input type = "checkbox" name = "policy" value = "1"> I must take all my assigned prerequisites unless it has been officially waived by the department or is
				not a requirement of my track/degree plan.<br/>


				<input type = "checkbox" name = "policy" value = "2"> I must meet with a Faculty Academic Advisor at least once a year to be advised.<br/>

				<input type = "checkbox" name = "policy" value = "3"> I know that I will not be allowed to enroll in a closed course. No exceptions. No waitlists.<br/>

				<input type = "checkbox" name = "policy" value = "4"> There is a 6-year window to complete all coursework.<br/>

	 			<br/>
	 			<input type = "checkbox" name = "policy" value = "5"> GPA is calculated on the + and &ndash; scale (A, A&ndash;, B+, B, B-, C+, C).
	 			<br/>

				<input type = "checkbox" name = "policy" value = "6"> I must have a core GPA &ge; 3.19, an elective GPA &ge; 3.0, and an overall GPA &ge; 3.0 to graduate.
				<br/>

				<input type = "checkbox" name = "policy" value = "7"> I may only repeat a course two times; I can only have a total of three repeats across all courses.
				<br/>

				<input type = "checkbox" name = "policy" value = "8"> I must make up any incomplete (I) grades by the deadline or it will turn into an F on my transcript.
				<br/>

				<input type = "checkbox" name = "policy" value = "9"> I know I must complete additional paperwork to change my major/program from CS to SE or from
				SE to CS at least two semesters prior to graduation.
				<br/>
				<input type = "checkbox" name = "policy" value = "10"> I know that if I miss three or more lectures in the beginning of any semester, I may be dropped or
				reassigned to another course in that semester.
				<br/>

				<p id = "student_signature"> Student&#39s tick here serves as his/ her signature and indicates agreement to above policies <input  id = "student_signature_input" type = "checkbox" name = "signature" value = "1"/><br/> </p>  

				<p id = "graduate_advisor_signature"> Graduate advisor&#39s tick here serves as his/her signature<input type = "checkbox"  id = "graduate_advisor_signature_input" name = "signature" value = "1"/><br/> </p>

				<div id = "button_group">
				<input class = "buttons" type = "submit" name = "submit" value = "submit" />
				<input class = "buttons" type = "reset" name = "reset" value = "reset" />
				</div>

	 		</fieldset>

	 	</form>
	 	<br/>
	 </div>
	 	<footer> 
			<div>
				<a href = "cs_degree_track2.html"> previous </a>
			</div>
		</footer>

	</body>
</html>