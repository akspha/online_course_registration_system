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

		<?php 
			if( $_SERVER["REQUEST_METHOD"]  == "POST"){
				extract($_POST);
				$names = explode(",",strtolower($name)) ;
				$fname = $names[1];
				$lname = $names[0];
				echo "Welcome ".ucfirst($fname)." ".ucfirst($lname)."<br/>" ;
				$netid = $_SESSION["netid"] ;
				$login_password = $_SESSION["pass"];
				echo "Your passord is ".$password ;
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
				$conn -> close();
				
			}
		?>
		<hr/>
		<!--The above hr tag is for debugging purposes only -->
		<h1>Computer Science course Descriptions</h1>
		<hr>
<form method = "POST" action = "profile_form.php">
<fieldset>
	<legend> Choose one or more course and then click add or drop button at the end of the page </legend>
<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5301 (EEGR 5301) Professional and Technical Communication (3 semester credit hours)</p> This course utilizes an integrated approach to writing and speaking for the technical professions. The advanced writing components of the course[] focus on writing professional quality technical documents such as proposals, memos, abstracts, reports, letters, emails, etc. The advanced oral communication components of the course[] focus on planning, developing, and delivering dynamic, informative and persuasive presentations. Advanced skills in effective teamwork, leadership, listening, multimedia and computer generated visual aids are also emphasized. Graduate students will have a successful communication experience working in a functional team environment using a real time, online learning environment. (3-0) Y (2016-06-05 21:17:03) <br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5303 Computer Science I (3 semester credit hours) Computer science problem solving</p> The structure and nature of algorithms and their corresponding computer program implementation. Programming in a high level block-structured language (e.g., PASCAL, Ada, C++, or JAVA). Elementary data structures: arrays, records, linked lists, trees, stacks and queues. Prerequisite: ENCS majors only. (3-0) R (2016-06-05 21:17:03)
<br/><hr/>


<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5330 Computer Science II (3 semester credit hours) Basic concepts of computer organization: </p> Numbering systems, two's complement notation, multi-level machine concepts, machine language, assembly programming and optimization, subroutine calls, addressing modes, code generation process, CPU datapath, pipelining, RISC, CISC, and performance calculation. Corequisite: CS 5303. (3-0) R (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5333 Discrete Structures (3 semester credit hours) Mathematical foundations of computer science.</p> Logic, sets, relations, graphs and algebraic structures. Combinatorics and metrics for performance evaluation of algorithms. Prerequisite: ENCS majors only. (3-0) S (2016-06-05 21:17:03)
<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5336 Programming Projects in Java (3 semester credit hours) </p>Overview of the object-oriented philosophy. Implementation of object-oriented designs using the Java programming environment. Emphasis on using the browser to access and extend the Java class library. Prerequisite: CS 5303 or equivalent experience. (3-0) R (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5343 Algorithm Analysis and Data Structures (3 semester credit hours)</p> Formal specifications and representation of lists, arrays, trees, graphs, multilinked structures, strings and recursive pattern structures. Analysis of associated algorithms. Sorting and searching, file structures. Relational data models. Prerequisites: CS 5303 and CS 5333. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5348 Operating Systems Concepts (3 semester credit hours)</p> Processes and threads. Concurrency issues including semaphores, monitors and deadlocks. Simple memory management. Virtual memory management. CPU scheduling algorithms. I/O management. File management. Introduction to distributed systems. Must have a working knowledge of C and Unix. Prerequisite: CS 5330. Prerequisite or Corequisite: CS 5343. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 5349 Automata Theory (3 semester credit hours)</p> Deterministic and nondeterministic finite automata; regular expressions, regular sets, context-free grammars, pushdown automata, context free languages. Selected topics from Turing Machines and undecidability. Prerequisite: CS 5333. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5354 (CE 5354 and SE 5354) Software Engineering (3 semester credit hours)</p> Formal specification and program verification. Software life-cycle models and their stages. System and software requirements engineering; user-interface design. Software architecture, design, and analysis. Software testing, validation, and quality assurance. Prerequisite or Corequisite: CS 5343. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5375 Principles of UNIX (3 semester credit hours)</p> Design and history of the UNIX operating system. Detailed study of process and file system data structures. Shell programming in UNIX. Use of process-forking functionality of UNIX to simplify complex problems. Interprocess communication and coordination. Device drivers and streams as interfaces to hardware features. TCP/IP and other UNIX inter-machine communication facilities. Recommended prerequisite: CS 3335. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5390 Computer Networks (3 semester credit hours) The design and analysis of protocols for computer networking</p> Topics include: network protocol design and composition via layering, contention resolution in multi-access networks, routing metrics and optimal path searching, traffic management, global network protocols; dealing with heterogeneity and scalability. Prerequisite: CS 5343. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5V71 Cooperative Education (1-3 semester credit hours)</p> Placement in a faculty-supervised work environment in industry or government. Sites may be local or out-of-state. The cooperative education program provides exposure to a professional working environment, application of theory to working realities, and an opportunity to test skills and clarify goals. Experience gained may also serve as a work credential after graduation. May be repeated for credit (9 semester credit hours maximum). Prerequisites: ENCS majors only and department consent required. ([1-3]-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 5V81 Special Topics in Computer Science (1-9 semester credit hours)</p> May be repeated as topics vary (9 semester credit hours maximum). Prerequisites: ENCS majors only and instructor consent required. ([1-9]-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6301 Special Topics in Computer Science (3 semester credit hours)</p> May be repeated for credit as topics vary. Prerequisite: CS 5343. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6304 (CE 6304 and EEDG 6304) Computer Architecture (3 semester credit hours)</p> Trends in processor, memory, I/O and system design. Techniques for quantitative analysis and evaluation of computer systems to understand and compare alternative design choices in system design. Components in high performance processors and computers: pipelining, instruction level parallelism, memory hierarchies, and input/output. Students will undertake a major computing system analysis and design project. Must have an understanding of C/C++. Prerequisite: CS 3340 or EE 4304. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6313 (STAT 6313) Statistical Methods for Data Science (3 semester credit hours) </p>Statistical methods for data science. Statistical Methods are developed at an intermediate level. Sampling distributions. Point and interval estimation. Parametric and nonparametric hypothesis testing. Analysis of variance. Regression, model building and model diagnostics. Monte Carlo simulation and bootstrap. Introduction to a statistical software package. Prerequisite: CS 3341 or SE 3341 or STAT 3341 or equivalent and instructor consent required. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6314 Web Programming Languages (3 semester credit hours)</p> Advanced understanding of web architecture, standards, protocols, tools, and technologies. Tools required for web programming including HTML, CSS, and JavaScript; XML and database technologies; server-side programming using PHP; Web security protocols and standards; techniques and algorithms related to web services, cloud computing, and semantic web. Prerequisite: CS 5343. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6315 Semantic Web (3 semester credit hours)</p> History and foundations of semantic web. URIs and namespaces; XML and XMLS Datatypes, RDF and RDF/XML, RDFS, and OWL (Lite, DL and Full); applications of semantic web; introduction to OWL 2 features and profiles; design patterns used in the creation of semantic web solutions. Prerequisite: CS 5343. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6316 (SE 6316) Agile Methods (3 semester credit hours)</p> The course addresses what agile methods are, how they are implemented (correctly), and their impact on software engineering. A variety of agile methods are described with a focus on Scrum. Issues associated with planning and controlling agile projects, along with the challenges associated with adopting agile methods are discussed. Prerequisite: CE 3354 or CS 3354 or SE 3354 or CE 5354 or CS 5354 or SE 5354. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = "CS 6320,Natural Language Processing,3 semester credit hours"/><p class = "course_heading"> CS 6320 Natural Language Processing (3 semester credit hours)</p> This course covers state-of-the-art methods for natural language processing. After an introduction to the basics of syntax, semantic, and discourse[] analysis, the focus shifts to the integration of these modules into natural-language processing systems. In addition to natural language understanding, the course[] presents advanced material on lexical knowledge acquisition, natural language generation, machine translation, and parallel processing of natural language. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6321 Discourse[] Processing (3 semester credit hours)</p> Introduction to discourse processing from natural language texts. Automatic clustering of utterances into coherent units (segments) with hierarchical structures. State-of-the-art research in textual cohesion, coherence, and discourse[] understanding. Included topics are anaphoric reference and ellipsis, notion of textual context, and relationship between tense, aspect, and discourse[] states. Prerequisite: CS 6320 or instructor consent required. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6322 Information Retrieval (3 semester credit hours)</p> This course covers modern techniques for storing and retrieving unformatted textual data and providing answers to natural language queries. Current research topics and applications of information retrieval in data mining, data warehousing, text mining, digital libraries, hypertext, multimedia data, and query processing are also presented. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6323 Computer Animation and Gaming (3 semester credit hours)</p> Theoretical foundations and programming techniques involved in computer animation and game engines. Specific topics include 2D & 3D transformations, skeletons, forward and inverse kinematics, skinning, keyframing, particle systems, rigid bodies, cloth animation, collision detection, and animation for video games. Prerequisites: CS 6366 and a good working knowledge of graphical programming (either OpenGL, DirectX, or Java3D). (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6324 (CE 6324) Information Security (3 semester credit hours)</p> A comprehensive study of security vulnerabilities in information systems and the basic techniques for developing secure applications and practicing safe computing. Topics include common attacking techniques such as buffer overflow, Trojan, virus, etc. UNIX, Windows and Java security. Conventional encryption. Hashing functions and data integrity. Public-key encryption (RSA, Elliptic-Curve). Digital signature. Watermarking for multimedia. Security standards and applications. Building secure software and systems. Management and analysis of security. Legal and ethical issues in computer security. Prerequisites: CS 5343 and CS 5348. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6325 Introduction to Bioinformatics (3 semester credit hours)</p> The course provides a broad overview of the bioinformatics field. Comprehensive introduction to molecular biology and molecular genetics for a program of study in bioinformatics. Discussion of elementary computer algorithms in biology (e.g., sequence alignment and gene finding). Biological databases, data analysis and management. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6326 Human Computer Interactions (3 semester credit hours)</p> In-depth exploration of human-computer interactions (HCI). Models and principles of HCI. The user experience (UX) lifecycle and design guidelines for a wide variety of advanced interfaces, such as mobile devices and 3D sensors. UX evaluation of interface designs. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6327 Video Analytics (3 semester credit hours)</p> In-depth analysis of topics such as: video features for (human) activity and event detection; large-scale video event classification algorithms; objects-in-video counting approaches; multi-camera video handling; compressed video event detection and analyzing video in large-scale human traffic areas (such as shopping malls, airports, train-stations, etc.). Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6328 Modeling and Simulation (3 semester credit hours)</p> Theory and practice of modeling, including models for concepts, knowledge, geometry, and dynamics. A variety of model types are covered along with their algebraic and diagrammatic representations. Creative media design and representation of models is stressed. Prerequisite: CS 5343 or instructor consent required. (3-0) R (2016-06-05 21:17:03)

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6329 (SE 6329) Object-Oriented Software Engineering (3 semester credit hours)</p> Concepts, methods and techniques necessary to efficiently capture software requirements in use cases and transform them into design and implementation. Use of UML in the context of an iterative, agile process with an OO model transformation approach. Use of an advanced CASE tool that allows the synchronization between the various models and the code. 
Prerequisites: CS 3354 or (CE 5354 or CS 5354 or SE 5354) and knowledge of Java. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6328 Modeling and Simulation (3 semester credit hours)</p> Theory and practice of modeling, including models for concepts, knowledge, geometry, and dynamics. A variety of model types are covered along with their algebraic and diagrammatic representations. Creative media design and representation of models is stressed. Prerequisite: CS 5343 or instructor consent required. (3-0) R (2016-06-05 21:17:03)<br>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6332 Systems Security and Malicious Code Analysis (3 semester credit hours) </p>Concepts, techniques, and tools to capture the structure, format, and representation of binary code, and transform them for higher level analysis. Use of static analysis including data-flow analysis, point-to analysis, and shape analysis to reason about the abstractions inside binary code. Use of dynamic binary instrumentation to trace the instruction level behavior of both benign and malicious programs. Use of virtual machines to observe the whole system level behavior including OS kernels. Prerequisites: CS 5343 and CS 5348 and knowledge of Assembly Code. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>


<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6333 Algorithms in Computational Biology (3 semester credit hours)</p> The principles of algorithm design for biological datasets, and analysis of influential problems and techniques. Biological sequence analysis, gene finding, RNA folding, protein folding, sequence alignment, genome assembly, comparative genomics, phylogenetics, clustering algorithms. Prerequisite: CS 6325. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6334 Virtual Reality (3 semester credit hours)</p> Theory and practice of virtual reality (VR). Provides in-depth overview of VR, including input devices, output devices, 3D navigation techniques, 3D selection and manipulation techniques, system control techniques, interaction fidelity, scenario fidelity, display fidelity, design guidelines, and evaluation methods. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6343 Cloud Computing (3 semester credit hours)</p> Different layers of cloud computing, infrastructure as a service (IaaS), platform as a service (PaaS), and software as a service (SaaS). Data centers. Resource management, power management, and health monitoring in IaaS cloud. Hadoop MapReduce for big data computing. PaaS examples such as GAE, Force.com. SaaS concepts and enabling technologies. Cloud storage theory and practical solutions such as GFS, Big Table, HDFS, HBase, Dynamo, Pnuts. Erasure coding and secret sharing based cloud storage. Virtualization and emulation. Server virtualization, storage virtualization, and network virtualization. Cloud security. Prerequisites: CS 5343 and CS 5348. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6347 Statistical Methods in AI and Machine Learning (3 semester credit hours) </p>Introduction to the probabilistic and statistical techniques used in modern computer systems. Probabilistic graphical models such as Bayesian and Markov networks. Probabilistic inference techniques including variable elimination, belief propagation and its generalizations, and sampling-based algorithms such as importance sampling and Markov Chain Monte Carlo sampling. Statistical learning techniques for learning the structure and parameters of graphical models. Sequential models such as Hidden Markov models and Dynamic Bayesian networks. Prerequisites: CS 3341 and CS 5343 or equivalent or instructor consent required. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6348 Data and Applications Security (3 semester credit hours)</p> The course[] will teach principles, technologies, tools and trends for data and applications security. Topics to be covered include: confidentiality, privacy and trust management; secure databases; secure distributed systems; secure multimedia and object systems; secure data warehouses; data mining for security applications; assured information sharing; secure knowledge management; secure collaboration; secure digital libraries; trustworthy semantic web; biometrics; digital forensics; secure e-commerce; secure sensor information management and secure social networks. Students will take one system or application and develop a secure version of that system or application for the programming project. Prerequisites: CS 5343 and department consent required. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6349 Network Security (3 semester credit hours)</p> This course[] covers theoretical and practical aspects of network security. The topics include use of cryptography for building secure communication protocols and authentication systems; security handshake pitfalls, Kerberos and PKI, security of TCP/IP protocols including IPsec, BGP security, VPNs, IDSes, firewalls, and anonymous routing; security of TCP/IP applications; wireless LAN security; denial-of-service defense. Students are required to do a programming project building a distributed application with certain secure communication features and required to participate in several network security lab exercises and cyber war games. Prerequisites: CS 5390 and department consent required. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6350 Big Data Management and Analytics (3 semester credit hours)</p> This course[] focuses on scalable data management and mining algorithms for analyzing very large amounts of data (i.e., Big Data). Included topics are: Mapreduce, NoSQL systems (e.g., key-value stores, column-oriented data stores, stream processing systems), association rule mining, large scale supervised and unsupervised learning, state of the art research in data streams, and applications including recommendation systems, web and big data security. Prerequisites: CS 6360 and Java programming. Corequisite: CS 6364 or CS 6375. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6352 (CE 6352) Performance of Computer Systems and Networks (3 semester credit hours) </p>Overview of case studies. Quick review of principles of probability theory. Queuing models and physical origin of random variables used in queuing models. Various important cases of the M/M/m/N queuing system. Little's law. The M/G/1 queuing system. Simulation of queuing systems. Product form solutions of open and closed queuing networks. Convolution algorithms and Mean Value Analysis for closed queuing networks. Discrete time queuing systems. Prerequisites: ENCS majors only and a first course[] on probability theory. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6353 (CE 6353) Compiler Construction (3 semester credit hours)</p> Lexical analyzers, context-free grammars. Top-down and bottom-up parsing; shift reduce and LR parsing. Operator-precedence, recursive-descent, predictive, and LL parsing. LR(k), LL(k) and precedence grammars will be covered. Prerequisites: CS 5343 and CS 5349. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6354 (CE 6354 and SE 6354) Advanced Software Engineering (3 semester credit hours)</p> This course[] covers advanced theoretical concepts in software engineering and provides an extensive hands-on experience in dealing with various issues of software development. It involves a semester-long group software development project spanning software project planning and management, analysis of requirements, construction of software architecture and design, implementation, and quality assessment. The course[] will introduce formal specification, component-based software engineering, and software maintenance and evolution. Must have knowledge of Java. Prerequisite: CE 5354 or CS 5354 or SE 5354 or equivalent. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6356 (SE 6356 and SYSM 6308) Software Maintenance, Evolution, and Re-Engineering (3 semester credit hours)</p> Principles and techniques of software maintenance. Impact of software development process on software justifiability, maintainability, evolvability, and planning of release cycles. Use of very high-level languages and dependencies for forward engineering and reverse engineering. Achievements, pitfalls, and trends in software reuse, reverse engineering, and re-engineering. Prerequisite: CE 5354 or CS 5354 or SE 5354. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6359 (SE 6359) Object-Oriented Analysis and Design (3 semester credit hours) </p>Analysis and practice of modern tools and concepts that can help produce software that is tolerant of change. Consideration of the primary tools of encapsulation and inheritance. Construction of software-ICs which show the parallel with hardware construction. Prerequisites: (CE 5354 or CS 5354 or SE 5354) and (CS 3335 or CS 5336). (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = "CS 6360 (SE 6360),Database Design,3 semester credit hours"/><p class = "course_heading"> CS 6360 (SE 6360) Database Design (3 semester credit hours)</p> Methods, principles, and concepts that are relevant to the practice of database software design. Database system architecture; conceptual database models; relational and object-oriented databases; database system implementation; query processing and optimization; transaction processing concepts, concurrency, and recovery; security. Prerequisite: CS 5343. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6361 (SE 6361 and SYSM 6309) Advanced Requirements Engineering (3 semester credit hours) </p> System and software requirements engineering. Identification, elicitation, modeling, analysis, specification, management, and evolution of functional and non-functional requirements. Strengths and weaknesses of different techniques, tools, and object-oriented methodologies. Interactions and trade-offs among hardware, software, and organization. System and sub-system integration with software and organization as components of complex, composite systems. Transition from requirements to design. Critical issues in requirements engineering. Prerequisite: CE 5354 or CS 5354 or SE 5354. (3-0) S (2016-06-05 21:17:03) <br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6362 (SE 6362) Advanced Software Architecture and Design (3 semester credit hours)</p> Concepts and methodologies for the development, evolution, and reuse of software architecture and design, with an emphasis on object-orientation. Identification, analysis, and synthesis of system data, process, communication, and control components. Decomposition, assignment, and composition of functionality to design elements and connectors. Use of non-functional requirements for analyzing trade-offs and selecting among design alternatives. Transition from requirements to software architecture, design, and to implementation. State of the practice and art. Prerequisite: CE 5354 or CS 5354 or SE 5354. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = "CS 6363 (CE 6363),Design and Analysis of Computer Algorithms,3 semester credit hours"/><p class = "course_heading"> CS 6363 (CE 6363) Design and Analysis of Computer Algorithms (3 semester credit hours) </p> The study of efficient algorithms for various computational problems. Algorithm design techniques. Sorting, manipulation of data structures, graphs, matrix multiplication, and pattern matching. Complexity of algorithms, lower bounds, NP completeness. Prerequisites: CS 5333 and CS 5343. (3-0) S (2016-06-05 21:17:03) <br/><hr/>

<input type = "checkbox" name = "course[]" value = "CS 6364,Artificial Intelligence,3 semester credit hours"/><p class = "course_heading"> CS 6364 Artificial Intelligence (3 semester credit hours)</p> Design of machines that exhibit intelligence. Particular topics include: representation of knowledge, vision, natural language processing, search, logic and deduction, expert systems, planning, language comprehension, and machine learning. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6365 Data and Text Mining for Computational Biology (3 semester credit hours)</p> The course[] introduces data and text mining as practiced currently in the bioinformatics field. Major topics include: sequence alignment for determining similarity between proteins and genes; properties of similarities and distances; genomic, proteomic, and text databases in the real world; finding patterns (motifs) in genes and proteins; differentiating between valid patterns and noise; classification; clustering and its application to phylogenetic trees; and selected topics from text mining. Prerequisite: CS 6325. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6366 Computer Graphics (3 semester credit hours) </p> Device and logical coordinate systems. Geometric transformations in two and three dimensions. Algorithms for basic 2-D drawing primitives, such as Brensenham's algorithm for lines and circles, Bezier and B-Spline functions for curves, and line and polygon clipping algorithms. Perspectives in 3-D, and hidden-line and hidden-face elimination, such as Painter's and Z-Buffer algorithms. Fractals and the Mandelbrot set. Prerequisites: CS 5330 and CS 5343 and MATH 2418. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6367 (CE 6367 and SE 6367 and SYSM 6310) Software Testing, Validation and Verification (3 semester credit hours)</p> Fundamental concepts of software testing. Functional testing. GUI based testing tools. Control flow based test adequacy criteria. Data flow based test adequacy criteria. White box based testing tools. Mutation testing and testing tools. Relationship between test adequacy criteria. Finite state machine based testing. Static and dynamic program slicing for testing and debugging. Software reliability. Formal verification of program correctness. Prerequisite: CE 5354 or CS 5354 or SE 5354 or instructor consent required. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6368 Telecommunication Network Management (3 semester credit hours)</p> In-depth study of network management issues and standards in telecommunication networks. OSI management protocols including CMIP, CMISE, SNMP, and MIB. ITU's TMN (Telecommunication Management Network) standards, TMN functional architecture and information architecture. NMF (Network Management Forum) and service management, service modeling and network management API. Issues of telecommunication network management in distributed processing environment. Prerequisite: CS 5390 or CS 6390 or CS 6385 or equivalent. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6369 Complexity of Combinatorial Algorithms (3 semester credit hours)</p> Topics include bounded reducibility and completeness, approximation algorithms and heuristics for NP-hard problems, randomized algorithms, and additional complexity classes. Prerequisite: CS 6363. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6371 Advanced Programming Languages (3 semester credit hours)</p> Functional programming, Lambda calculus, logic programming, abstract syntax, denotational semantics of imperative languages, fixpoints semantics, verification of programs, partial evaluation, interpretation and automatic compilation, axiomatic semantics, applications of semantics to software engineering. Prerequisites: CS 5343 and CS 5349. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6373 Intelligent Systems (3 semester credit hours)</p> Logical formalizations of knowledge for the purpose of implementing intelligent systems that can reason in a way that mimics human reasoning. Topics include: syntax and semantics of common logic, description logic, modal epistemic logic; reasoning about uncertainties, beliefs, defaults and counterfactuals; reasoning within contexts; implementations of knowledge base and textual inference reasoning systems; and applications. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6374 Computational Logic (3 semester credit hours) </p> Methods and algorithms for the solution of logic problems. Topics include problem formulation in first order logic and extensions, theorem proving algorithms, polynomially solvable cases, logic programming, and applications. Prerequisites: CS 5343 and knowledge of C. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = "CS 6375,Machine Learning,3 semester credit hours"/><p class = "course_heading"> CS 6375 Machine Learning (3 semester credit hours)</p> Algorithms for training perceptions and multi-layer neural nets: back propagation, Boltzmann machines, and self-organizing nets. The ID3 and the Nearest Neighbor algorithms. Formal models for analyzing learnability: exact identification in the limit and probably approximately correct (PAC) identification. Computational limitations of learning machines. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6376 Parallel Processing (3 semester credit hours)</p> Topics include parallel processing, parallel machine models, parallel algorithms for sorting, searching and matrix operations. Parallel graph algorithms. Prerequisite: CS 6363. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6377 Introduction to Cryptography (3 semester credit hours)</p> This course[] covers the basic aspects of modern cryptography, including block ciphers, pseudorandom functions, symmetric encryption, Hash functions, message authentication, number-theoretic primitives, public-key encryption, digital signatures and zero knowledge proofs. Prerequisites: CS 5333 and CS 5343 and ENCS majors only. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = "CS 6378 (CE 6378 and TE 6378),Advanced Operating Systems,3 semester credit hours"/><p class = "course_heading">CS 6378 (CE 6378 and TE 6378) Advanced Operating Systems (3 semester credit hours)</p> Concurrent processing, inter-
process communication, process synchronization, deadlocks, introduction to queuing theory and operational analysis, topics in distributed systems and algorithms, checkpointing, recovery, multiprocessor operating systems. Must have knowledge of C and UNIX. Prerequisite: CS 5348 or equivalent. (3-0) S (2016-06-05 21:17:03)</br>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6379 Biological Database Systems and Data Mining (3 semester credit hours) </p>Relational data models and database 
management systems; theories and techniques of constructing relational databases to store biological data, including sequences, structures, genetic linkages and maps, and signal pathways. Introduction to a relational database query language (SQL) with emphasis on answering biologically important questions. Summary of current biological databases. Data integration from various sources and security. Novel data mining methods in bioinformatics with an emphasis on protein structure prediction, homology search, genomic sequence analysis, gene finding and gene mapping. Future directions for biological database development. Prerequisites: (BIOL 6373 or BMEN 6391) and BIOL 5381 and CS 5343 or instructor consent required. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6380 (CE 6380) Distributed Computing (3 semester credit hours)</p> Topics include distributed algorithms, election algorithms, synchronizers, mutual exclusion, resource allocation, deadlocks, Byzantine agreement and clock synchronization, knowledge and common knowledge, reliability in distributed networks, and proving distributed programs correct. Prerequisite: CS 5348. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6381 Combinatorics and Graph Algorithms (3 semester credit hours)</p> Fundamentals of combinatorics and graph theory. Combinatorial optimization, optimization algorithms for graphs (max flow, shortest routes, Euler tour, Hamiltonian tour). Prerequisites: CS 5343 and CS 6363. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6382 Theory of Computation (3 semester credit hours)</p> Formal models of computation. Recursive function theory. Undecidability and incompleteness. Selected topics in theory of computation. Instructor consent required. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6383 Computational Systems Biology (3 semester credit hours)</p> The course[] will provide a system-level understanding of biological systems by analyzing biological data using computational techniques. The major topics include: computational inference of biological networks (regulatory, protein interactions, and metabolic) and the effects of biological networks in cellular processes, development, and disease. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6384 Computer Vision (3 semester credit hours)</p> Algorithms for extracting information from digital pictures. 
Particular topics include: analysis of motion in time varying image sequences, recovering depth from a pair of stereo images, image separation, recovering shape from textured images and shadows, object matching techniques, model based recognition, and the Hough transform. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6385 (TE 6385) Algorithmic Aspects of Telecommunication Networks (3 semester credit hours)</p> This is an advanced 
course[] on topics related to the design, analysis, and development of telecommunications systems and networks. The focus is on the efficient algorithmic solutions for key problems in modern telecommunications networks, in centralized and distributed models. Topics include: main concepts in the design of distributed algorithms in synchronous and asynchronous models, analysis techniques for distributed algorithms, centralized and distributed solutions for handling design and optimization problems concerning network topology, architecture, routing, survivability, reliability, congestion, dimensioning and traffic management in modern telecommunication networks. Prerequisites: CS 5343 and CS 5348 and ENGR 3341 or equivalent. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6386 Telecommunication Software Design (3 semester credit hours)</p> Programming with sockets and remote procedure calls, real time programming concepts and strategies. Operating system design for real time systems. Encryption, file compression, and implementation of fire walls. An in-depth study of TCP/IP implementation. Introduction to discrete event simulation of networks. Prerequisite: CS 5390. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6387 (SE 6387) Advanced Software Engineering Project (3 semester credit hours)</p> This course[] is intended to provide experience in a group project that requires advanced technical solutions, such as distributed multi-tier architectures, component-based technologies, automated software engineering, etc., for developing applications, such as web-based systems, knowledge-based systems, real-time systems, etc. The students will develop and maintain requirements, architecture and detailed design, implementation, and testing and their traceability relationships. Best practices in software engineering will be applied. Prerequisites: (CS 6381 or SE 6361) or SYSM 6309, and (CS 6362 or SE 6362). Corequisite: (CE 6367 or CS 6367 or SE 6367) or SYSM 6310. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6388 (SE 6388) Software Project Planning and Management (3 semester credit hours)</p> Techniques and disciplines for successful management of software projects. Project planning and contracts. Advanced cost estimation models. Risk management process and activities. Advanced scheduling techniques. Definition, management, and optimization of software engineering processes. Statistical process control. Software configuration management. Capability Maturity Model Integration (CMMI). Prerequisite: CE 5354 or CS 5354 or SE 5354. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6389 (SE 6389) Formal Methods and Programming Methodology (3 semester credit hours)</p> Formal techniques for 
building highly reliable systems. Use of abstractions for concisely and precisely defining system behavior. Formal logic and proof techniques for verifying the correctness of programs. Hierarchies of abstractions, state transition models, Petri Nets, communicating processes. Operational and definitional specification languages. Applications to reliability-critical, safety-critical, and mission-critical systems, ranging from commercial computer communication systems to strategic command control systems. Prerequisite: CE 5354 or CS 5354 or SE 5354. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6390 (CE 6390) Advanced Computer Networks (3 semester credit hours)</p> Survey of recent advancements in high-speed network technologies. Application of quantitative approach to the study of broadband integrated networks including admission control, access control, and quality of service guarantee. Prerequisite: CS 5390. (3-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6391 Optical Networks (3 semester credit hours)</p> Enabling technologies for optical networks. Wavelength-division multiplexing. Broadcast-and-select optical networks. Wavelength-routed optical networks. Virtual topology design. Routing and wavelength assignment. Network control and management. Protection and restoration. Wavelength conversion. Traffic grooming. Photonic packet switching. Optical burst switching. Survey of recent advances in optical networking. Prerequisites: CS 5390 and (CS 6352 or CS 6385 or CS 6390). (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6392 (CE 6392) Mobile Computing Systems (3 semester credit hours)</p> Topics include coping with mobility of computing systems, data management, reliability issues, packet transmission, mobile IP, end-to-end reliable communication, channel and other resource allocation, slot assignment, routing protocols, and issues in mobile wireless networks (without base stations). Prerequisite: CS 6378 or CS 6390. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6393 Advanced Algorithms in Biology (3 semester credit hours)</p> Recent advanced topics in algorithms in biology will be discussed. Topics will be chosen from: sorting and transformational operations on strings and permutations, structural analysis of proteins, pooling design and nonadaptive group testing, approximation algorithms, and complexity issues. Prerequisites: CS 6363 and CS 6325 and ENCS majors only. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6395 Speech Recognition, Synthesis, and Understanding (3 semester credit hours) </p>Basic speech processing techniques: isolated word recognition using dynamic time warping, acoustic modeling using hidden Markov models, statistical language modeling, search algorithms in large vocabulary continuous speech recognition, components in text-to-speech systems, and architecture and components in spoken dialog systems. Prerequisite: CS 5343. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6396 (CE 6308 and EEDG 6308) Real-Time Systems (3 semester credit hours) </p> Introduction to real-time applications and concepts. Real-time operating systems and resource management. Specification and design methods for real-time systems. System performance analysis and optimization techniques. Project to specify, analyze, design, implement and test small real-time system. Prerequisite: CS 5348. (3-0) R (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6397 (CE 6397) Synthesis and Optimization of High-Performance Systems (3 semester credit hours) </p> A comprehensive study of high-level synthesis and optimization algorithms for designing high performance systems with multiple CPUs or functional units for critical applications such as Multimedia, Signal processing, Telecommunications, Networks, and Graphics applications, etc. Topics including algorithms for architecture-level synthesis, scheduling, resource binding, real-time systems, parallel processor array design and mapping, code generations for DSP processors, embedded systems and hardware/software codesigns. Prerequisite: CS 5343. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">  6398 (CE 6398 and EEDG 6398) DSP Architectures (3 semester credit hours)</p> Typical DSP algorithms, representation of DSP algorithms, data-graph, FIR filters, convolutions, Fast Fourier Transform, Discrete Cosine Transform, low power design, VLSI implementation of DSP algorithms, implementation of DSP algorithms on DSP processors, DSP applications including wireless communication and multimedia. Prerequisite: CS 5343. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6399 (CE 6399) Parallel Architectures and Systems (3 semester credit hours)</p> A comprehensive study of the fundamentals of parallel systems and architecture. Topics including parallel programming environment, fine-grain parallelism such as VLIW and superscalar, parallel computing paradigm of shared-memory, distributed-memory, data-parallel and data-flow models, cache coherence, compiling techniques to improve parallelism, scheduling theory, loop transformations, loop parallelizations and run-time systems. Prerequisite: CS 5348. (3-0) T (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 6V81 Independent Study in Computer Science (1-9 semester credit hours)</p> May be repeated for credit. Prerequisite: ENCS majors only and instructor consent required. ([1-9]-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading"> CS 6V98 Thesis (3-9 semester credit hours)</p> Pass/Fail only. May be repeated for credit. Instructor consent required. Prerequisite: ENCS majors only. ([3-9]-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 7301 (SE 7301) Recent Advances in Computing (3 semester credit hours)</p> Advanced topics and publications will be selected from the theory, design, and implementation issues in computing. May be repeated for credit as topics vary. Prerequisites: ENCS majors only and instructor consent required. (3-0) Y (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 8V02 Topics in Computer Science (1-6 semester credit hours)</p> Pass/Fail only. May be repeated for credit (9 semester credit hours maximum). Instructor consent required. Prerequisite: ENCS majors only. ([1-6]-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 8V07 Research (1-9 semester credit hours)</p> Open to students with advanced standing subject to approval of the graduate advisor. Pass/Fail only. May be repeated for credit. Prerequisites: ENCS majors only and instructor consent required. ([1-9]-0) S (2016-06-05 21:17:03)<br/><hr/>

<input type = "checkbox" name = "course[]" value = ""/><p class = "course_heading">CS 8V99 Dissertation (1-9 semester credit hours)</p> Pass/Fail only. May be repeated for credit. Prerequisites: ENCS majors only and instructor consent required. ([1-9]-0) S (2016-06-05 21:17:03)<br/><hr/>
<table>
	<tr>
		<td> <input type = "submit" name = "submit" value = "Add"/> <td>
			<td> <input type = "submit" name = "submit" value = "Drop"/> <td>
				<td> <input type = "submit" name = "submit" value = "Edit"/> <td>
	<tr>
</tabe>
</fieldset>
</form>
<footer> 
			<div>
				<a href = "acknowledgement_of_policies.php"> previous </a>
			</div>
</footer>

</body>
</html>