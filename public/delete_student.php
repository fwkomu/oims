<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$student = find_student_by_username($_GET["username"]);
	if (!$student) {
		// student username was missing or invalid or
		// student couldn't be found in database
		redirect_to("manage_students.php");
	}
			
			$username = $student["username"];
			$query = "DELETE from users WHERE username = {$username} AND user_role = 'student' LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) == 1) {
				//Success
				$_SESSION["message"] = "Student deleted.";
				redirect_to("manage_students.php");
			} else {
				//Failure
				$_SESSION["message"] = "Student deletion failed.";
				redirect_to("manage_students.php");
			}
			
?>
