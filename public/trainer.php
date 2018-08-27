<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_logged_in(); ?>
<?php $layout_context = "trainer"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">

		<h2>Trainer Menu</h2>
		<p>Welcome to the trainer area, <?php echo htmlentities($_SESSION["username"]); ?>.</a> </p>
		
		<!--Dashboard boxes code-->
		<a href="logs.php">
			<div class="dashboard" id="manage_admins" align="center">
				<i class="fa fa-eye fa-2x"><br /><b align="center">View Logs</b></i>
			</div>
		</a>

		<a href="#.php">
			<div class="dashboard" id="manage_students" align="center">
				<i class="fa fa-calendar-check-o fa-2x"><br /><b align="center">Rate Student</b></i>
			</div>
		</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>