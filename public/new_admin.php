<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	if (isset($_POST['submit'])) {
		//Process the form
		
		// validations
		$required_fields = array("username", "password");
		validate_presences($required_fields);
		
		$fields_with_max_lengths = array("username" => 30);
		validate_max_lengths($fields_with_max_lengths);
		
		if (empty($errors)) {
			// Perform Create

			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);
			$adminmail = mysql_prep($_POST["adminmail"]);
		
			$query = "INSERT INTO users (";
			$query .= " username, email, hashed_password, user_role";
			$query .= ") VALUES (";
			$query .= " '{$username}', '{$adminmail}', '{$hashed_password}', 'admin'";
			$query .= ")";
			$result = mysqli_query($connection, $query);
			
			if($result){
				//Success
				$_SESSION["message"] = "Admin created. We sent an email with the login details. Check junk/spam too!";
				if (welcome_email($_POST['adminmail'], "Account Log in Details", $_POST["username"], $_POST["password"])) {
					redirect_to("manage_admins.php");
				} else {
					//Email failure
					$_SESSION["message"] = "Admin creation successful but account details email failed.";
				}
			} else {
				//Failure
				$_SESSION["message"] = "Admin creation failed.";
			}
		}
	} else {
		// This is probably a GET request
		
	} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = "admin"; ?>
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
		
		<h2>Create Admin</h2>
		<form action="new_admin.php" method = "POST">
			<p>Username:
				<input type="text" name="username" value="" />
			</p>
			<p>Email:
                <input type="email" name="adminmail" value="" />
            </p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Create Admin" />
		</form>
		<br />
		<a href="manage_admins.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>