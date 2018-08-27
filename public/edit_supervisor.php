<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	$supervisor = find_supervisor_by_id($_GET["id"]);
	
	if (!$supervisor) {
		// student ID was missing or invalid or
		// student couldn't be found in database
		redirect_to("manage_supervisors.php");
	}
?>

<?php
	if (isset($_POST['submit'])) {
		//Process the form
		
		// validations
		$required_fields = array("username", "password");
		validate_presences($required_fields);
		
		$fields_with_max_lengths = array("username" => 30);
		validate_max_lengths($fields_with_max_lengths);
		
		if (empty($errors)) {
			// Perform Update
			
			$id = $supervisor["id"];
			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);
		
			$query = "UPDATE users SET ";
			$query .= "username = '{$username}', ";
			$query .= "hashed_password = '{$hashed_password}' ";
			$query .= "WHERE id = {$id} ";
			$query .= "AND user_role = 'supervisor' ";
			$query .= "LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) == 1) {
				//Success
				$_SESSION["message"] = "Supervisor updated.";
				redirect_to("manage_supervisors.php");
			} else {
				//Failure
				$_SESSION["message"] = "Supervisor update failed.";
			}
		}
	} else {
		// This is probably a GET request
		
	} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = "supervisor"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>Edit Supervisor: <?php echo htmlentities($supervisor["username"]); ?></h2>
		<form action="edit_supervisor.php?id=<?php echo urlencode($supervisor["id"]); ?>" method = "POST">
			<p>Username:
				<input type="text" name="username" value="<?php echo htmlentities($supervisor["username"]); ?>" />
			</p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Edit Supervisor" />
		</form>
		<br />
		<a href="manage_supervisors.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>