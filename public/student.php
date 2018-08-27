<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "student"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">

		<h2>Student Menu</h2>
		<p>Welcome to the student area, <?php echo htmlentities($_SESSION["username"]); ?>.</a> </p>
		
		<!--Dashboard boxes code-->
		<a href="profile.php">
			<div class="dashboard" id="manage_admins" align="center">
				<i class="fa fa-user fa-2x"><br /><b align="center">Profile</b></i>
			</div>
		</a>

		<a href="new_log.php">
			<div class="dashboard" id="manage_students" align="center">
				<i class="fa fa-calendar-plus-o fa-2x"><br /><b align="center">Create logs</b></i>
			</div>
		</a>

		<a href="logs.php">
			<div class="dashboard" id="manage_trainers" align="center">
				<i class="fa fa-eye fa-2x"><br /><b align="center">View Logs</b></i>
			</div>
		</a>

		<a href="#.php">
			<div class="dashboard" id="manage_supervisors" align="center">
				<i class="fa fa-calendar-check-o fa-2x"><br /><b align="center">View Ratings</b></i>
			</div>
		</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>