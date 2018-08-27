<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header.php"); ?>
<?php find_selected_page(true); ?>

<div id="main">
	<div id="navigation">
	</div>
	<div id="page">		
		
		<h3>ABOUT THE ONLINE INTERNSHIP MANAGEMENT SYSTEM (OIMS)</h3>	
		
		<p> 
			OIMS is an acronym that stands for Online Internship Management System. <br />
			This system is meant to assist the student keep a record of field activities. <br />
			It will show the organization in which the student has worked on attachment and the period of time spent in that organization.
		</p>
		
		<h3>Daily Report</h3>
				The student should record clearly the work done on each day during the period of attachment. <br />
				Students are required to present their logs periodically to the lecturer/supervisor for assessment of content and progress.<br />
				The lecturer/supervisor can use any part for his/her comment where necessary.<br />
				
		<h3>Report Writing</h3>
			At the end of the attachment exercise, a student is expected to write a report on the experiences acquired during the attachment. <br />
			The organization of the report should take the following format:<br />
				a)	Introduction<br />
				b)	Mainframe of report<br />
						-	General description of the organization and departments where attached<br />
						-	General activities undertaken in the organization<br />
						-	Specific activities undertaken during attachment<br />
						-	A profile in skills and competencies gained<br />
						-	Activities in which the student applied his/her skills for the benefit of the organization<br />
				c)	Analysis, observations and critique<br />
				d)	Summary and conclusions<br />
			
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>