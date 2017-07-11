
CREATE TABLE `approved_courses` (
 `netid` varchar(50) NOT NULL,
 `courseid` int(11) NOT NULL,
 `date_of_approval` date NOT NULL,
 PRIMARY KEY (`courseid`,`netid`),
 KEY `netid` (`netid`,`courseid`),
 CONSTRAINT `approved_courses_ibfk_1` FOREIGN KEY (`netid`, `courseid`) REFERENCES `registered_courses` (`netid`, `courseid`)
);

CREATE TABLE `courses` (
 `courseid` int(11) NOT NULL,
 `coursename` varchar(50) NOT NULL,
 `prefix` varchar(50) NOT NULL,
 `credits` int(11) NOT NULL,
 `description` varchar(2000) NOT NULL,
 `trackid` int(11) NOT NULL,
 PRIMARY KEY (`courseid`,`trackid`),
 KEY `trackid` (`trackid`),
 CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`trackid`) REFERENCES `degree_plan` (`track_id`)
) ;

CREATE TABLE `degree_plan` (
 `track_id` int(11) NOT NULL,
 `degree_id` int(11) NOT NULL,
 `dept_id` int(11) NOT NULL,
 `degree_name` varchar(50) NOT NULL,
 `track_name` varchar(50) NOT NULL,
 PRIMARY KEY (`track_id`,`degree_id`,`dept_id`),
 KEY `dept_id` (`dept_id`),
 CONSTRAINT `degree_plan_ibfk_1` FOREIGN KEY (`dept_id`) REFERENCES `department` (`id`)
) ; 


CREATE TABLE `department` (
 `id` int(11) NOT NULL,
 `name` varchar(50) NOT NULL,
 `init` varchar(4) NOT NULL,
 PRIMARY KEY (`id`)
);

CREATE TABLE `grades` (
 `netid` varchar(50) NOT NULL,
 `courseid` int(11) NOT NULL,
 `gpa` float NOT NULL,
 PRIMARY KEY (`netid`,`courseid`),
 KEY `grades_ibfk_2` (`courseid`),
 CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`netid`) REFERENCES `user_personal` (`netid`),
 CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`courseid`) REFERENCES `courses` (`courseid`)
) ;

CREATE TABLE `logindetails` (
 `uname` varchar(50) NOT NULL,
 `pwd` varchar(50) NOT NULL,
 PRIMARY KEY (`uname`)
) ;

CREATE TABLE `logindetails_admin` (
 `uname` varchar(50) NOT NULL,
 `pwd` varchar(50) NOT NULL,
 PRIMARY KEY (`uname`,`pwd`)
) ;


CREATE TABLE `registered_courses` (
 `netid` varchar(50) NOT NULL,
 `prefix` varchar(50) NOT NULL,
 `courseid` int(11) NOT NULL,
 `coursename` varchar(50) NOT NULL,
 `credits` int(11) NOT NULL,
 PRIMARY KEY (`netid`,`courseid`),
 CONSTRAINT `registered_courses_ibfk_1` FOREIGN KEY (`netid`) REFERENCES `user_personal` (`netid`)
) ;


	
CREATE TABLE `transferred_courses` (
 `netid` varchar(50) NOT NULL,
 `courseid` int(11) NOT NULL,
 PRIMARY KEY (`netid`,`courseid`)
) ;


	
CREATE TABLE `user_academic` (
 `netid` varchar(50) NOT NULL,
 `password` varchar(50) NOT NULL,
 `track_id` int(11) NOT NULL,
 `admission_date` date NOT NULL,
 `graduation_date` date NOT NULL,
 PRIMARY KEY (`netid`,`track_id`),
 KEY `track_id` (`track_id`),
 CONSTRAINT `user_academic_ibfk_1` FOREIGN KEY (`netid`) REFERENCES `user_personal` (`netid`),
 CONSTRAINT `user_academic_ibfk_2` FOREIGN KEY (`track_id`) REFERENCES `degree_plan` (`track_id`)
) ;

CREATE TABLE `user_personal` (
 `netid` varchar(50) NOT NULL,
 `fname` varchar(50) DEFAULT NULL,
 `lname` varchar(50) DEFAULT NULL,
 `phone` varchar(50) DEFAULT NULL,
 `email` varchar(50) DEFAULT NULL,
 PRIMARY KEY (`netid`)
) 

CREATE TABLE `waived_courses` (
 `netid` varchar(50) NOT NULL,
 `courseid` int(11) NOT NULL,
 PRIMARY KEY (`netid`,`courseid`),
 KEY `courseid` (`courseid`)
);