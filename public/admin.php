<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">

		<h2>Admin Menu</h2>
		<p>Welcome to the admin area, <?php echo htmlentities($_SESSION["username"]); ?>.</a> </p>
		
		<!--Dashboard boxes code-->
		<h2><i>Manage User Profiles</i></h2>
		<a href="manage_admins.php">
			<div class="dashboard" id="manage_admins" align="center">
				<i class="fa fa-users fa-2x"><br /><b align="center">Admin Users</b></i>
			</div>
		</a>

		<a href="manage_students.php">
			<div class="dashboard" id="manage_students" align="center">
				<i class="fa fa-graduation-cap fa-2x"><br /><b align="center">Student Users</b></i>
			</div>
		</a>

		<a href="manage_trainers.php">
			<div class="dashboard" id="manage_trainers" align="center">
				<i class="fa fa-briefcase fa-2x"><br /><b align="center">Trainer Users</b></i>
			</div>
		</a>

		<a href="manage_supervisors.php">
			<div class="dashboard" id="manage_supervisors" align="center">
				<i class="fa fa-institution fa-2x"><br /><b align="center">Supervisor Users</b></i>
			</div>
		</a>
		
		<a href="schedule.php">
			<div class="dashboard" id="assign_supervisor" align="center">
				<i class="fa fa-male fa-2x">&nbsp;<b align="center">Assign Supervisor</b></i>
			</div>
		</a>
		
		<a href="logs.php">
			<div class="dashboard" id="logs" align="center">
				<i class="fa fa-eye fa-2x"><br /><b align="center">View Logs</b></i>
			</div>
		</a>

		<a href="#.php">
			<div class="dashboard" id="ratings" align="center">
				<i class="fa fa-calendar-check-o fa-2x"><br /><b align="center">View Ratings</b></i>
			</div>
		</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>