<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "public"; ?>
<?php include("../includes/layouts/header.php"); ?>

<!-- // Get $user_role
		$query = "SELECT user_role FROM users;";
		$result = mysqli_query($connection, $query);
		$resultcheck = mysqli_num_rows($result);
		
		if ($resultcheck > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
					
			// Redirection based on user_roles
			if ($user_role == 'student') {
				$redirect = 'student.php';
			} else if ($user_role == 'trainer') {
				$redirect = 'trainer.php';
			} else if ($user_role == 'supervisor') {
				$redirect = 'supervisor.php';
			} else if ($user_role == 'admin') {
				$redirect = 'admin.php';
			}
			redirect_to($redirect);
			}
		} -->

<!--<div class="list-group">
  <a class="list-group-item" href="index.php"><i class="fa fa-home fa-fw" aria-hidden="true"></i>&nbsp; Home</a>
  <a class="list-group-item" href="login.php"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>&nbsp; Login</a>
  <a class="list-group-item" href="logout.php"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>&nbsp; Logout</a>
</div>-->

<!--<a href="manage_content.php">
	<div class="dashboard" id="manage_content" align="center">
		<i class="fa fa-folder-open-o fa-2x"><br /><b align="center">Website Content</b></i>
	</div>
</a>-->

<!--
	<a class="list-group-item" href="logout.php"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</a>
-->


<!--
fa-users
fa-graduation-cap
fa-folder-open-o
fa-briefcase
fa-institution
fa-sign-in
fa-sign-out
-->