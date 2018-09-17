<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	$trainer = find_trainer_by_username($_GET["username"]);
	
	if (!$trainer) {
		// trainer username was missing or invalid or
		// trainer couldn't be found in database
		redirect_to("manage_trainers.php");
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
			
			//$id = $trainer["id"];
			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);
			$trainermail = mysql_prep($_POST["trainermail"]);
		
			$query = "UPDATE users SET ";
			$query .= "username = '{$username}', ";
			$query .= "hashed_password = '{$hashed_password}' ";
			$query .= "trainermail = '{$trainermail}', ";
			$query .= "AND user_role = 'trainer' ";
			$query .= "LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) == 1) {
				//Success
				$_SESSION["message"] = "Trainer updated.";
				redirect_to("manage_trainers.php");
			} else {
				//Failure
				$_SESSION["message"] = "Trainer update failed.";
			}
		}
	} else {
		// This is probably a GET request
		
	} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = "student"; ?>
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
		
		<h2>Edit Trainer: <?php echo htmlentities($trainer["username"]); ?></h2>
		<form action="edit_trainer.php?username=<?php echo urlencode($trainer["username"]); ?>" method = "POST">
			<p>Username:
				<input type="text" name="username" value="<?php echo htmlentities($trainer["username"]); ?>" />
			</p>
			<p>Email:
                <input type="email" name="trainermail" value="<?php echo htmlentities($trainer["email"]); ?>" />
            </p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Edit Trainer" />
		</form>
		<br />
		<a href="manage_trainers.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>