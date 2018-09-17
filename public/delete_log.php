<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$log = find_log_by_date($_GET["username"]);
	if (!$log) {
		// trainer ID was missing or invalid or
		// trainer couldn't be found in database
		redirect_to("logs.php");
	}
			
			$date = $log["date"];
			$query = "DELETE from logs WHERE date = {$date} LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) == 1) {
				//Success
				$_SESSION["message"] = "Log deleted.";
				redirect_to("logs.php");
			} else {
				//Failure
				$_SESSION["message"] = "Log deletion failed.";
				redirect_to("logs.php");
			}
			
?>
