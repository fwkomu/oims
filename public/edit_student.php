<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	$student = find_user_by_id($_GET["username"]);
	
	if (!$student) {
		// student username was missing or invalid or
		// student couldn't be found in database
		redirect_to("manage_students.php");
	}
?>

<?php
	if (isset($_POST['submit'])) {
		//Process the form
		
		// validations
		$required_fields = array("username", "email", "password");
		validate_presences($required_fields);
		
		$fields_with_max_lengths = array("username" => 30);
		validate_max_lengths($fields_with_max_lengths);
		
		if (empty($errors)) {
			// Perform Update
			
			$id = $student["username"];
			$username = mysql_prep($_POST["username"]);
			$hashed_password = password_encrypt($_POST["password"]);
			$email = mysql_prep($_POST["email"]);
		
			$query = "UPDATE users SET ";
			$query .= "username = '{$username}', ";
			$query .= "email = '{$email}', ";
			$query .= "hashed_password = '{$hashed_password}' ";
			$query .= "WHERE username = '{$id}' ";
			$query .= "AND user_role = 'student' ";
			$query .= "LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) == 1) {
				//Success
				$_SESSION["message"] = "Student updated.";
				redirect_to("manage_students.php");
			} else {
				//Failure
				$_SESSION["message"] = "Student update failed.";
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
		
		<h2>Edit Student: <?php echo htmlentities($student["username"]); ?></h2>
		<form action="edit_student.php?username=<?php echo urlencode($student["username"]); ?>" method = "POST">
			<p>Username:
				<input type="text" name="username" value="<?php echo htmlentities($student["username"]); ?>" />
			</p>
			<p>Email:
                <input type="email" name="email" value="<?php echo htmlentities($student["email"]); ?>" />
            </p>
			<p>Password:
				<input type="password" name="password" value="" />
			</p>
			<input type="submit" name="submit" value="Edit Student" />
		</form>
		<br />
		<a href="manage_students.php">Cancel</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>