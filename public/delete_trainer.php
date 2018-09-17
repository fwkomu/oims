<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$trainer = find_trainer_by_username($_GET["username"]);
	if (!$trainer) {
		// trainer username was missing or invalid or
		// trainer couldn't be found in database
		redirect_to("manage_trainers.php");
	}
			
			$username = $trainer["username"];
			$query = "DELETE from users WHERE username = {$username} AND user_role = 'trainer' LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) == 1) {
				//Success
				$_SESSION["message"] = "Trainer deleted.";
				redirect_to("manage_trainers.php");
			} else {
				//Failure
				$_SESSION["message"] = "Trainer deletion failed.";
				redirect_to("manage_trainers.php");
			}
			
?>
