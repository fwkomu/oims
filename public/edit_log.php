<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
$message = '';
if (isset($_SESSION["username"])) {
    $current_username = $_SESSION["username"];
} else {
    $current_username = NULL;
}
retrieve_logs_data();
?>
<?php find_current_user($current_username); ?>

<?php //find_selected_log(); ?>

<?php
	if (isset($_POST['submit'])) {
		//Process the form
		
		$date = mysql_prep($_POST["date"]);
		$entry = mysql_prep($_POST["entry"]);
			
		// validations
		$required_fields = array("date", "entry");
		validate_presences($required_fields);
		
		if (empty($errors)) {
			
			// Perform Update			
			$query = "UPDATE pages SET ";
			$query .= "date = '{$date}', ";
			$query .= "entry = '{$entry}' ";
			$query .= "WHERE DATE = '{$date}' ";
			$query .= "LIMIT 1";
			$result = mysqli_query($connection, $query);
			
			if($result && mysqli_affected_rows($connection) >= 0) {
				//Success
				$_SESSION["message"] = "Log updated.";
				redirect_to("logs.php");
			} else {
				//Failure
				$message = "Log update failed.";
			}
		}
	} else {
		// This is probably a get request
	} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="student.php">&laquo; Main menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		<?php
		$query = "SELECT * FROM users WHERE username = '" . $current_username . "';";
        $result = mysqli_query($connection, $query);
        $resultcheck = mysqli_num_rows($result);
        $logscheck = retrieve_logs_data();

        if ($resultcheck > 0) {
            $row = mysqli_fetch_assoc($result);
            $rowp = mysqli_fetch_assoc($logscheck);
        ?>
                <h2>Edit <?php echo htmlentities($_SESSION["username"]); ?>'s Log</h2>
				<form action="edit_log.php" method="POST">
					<input type="date" name="date" value="" />
					<input type="submit" name="submit" value="Retrieve" />
					<p>
					Notes on work done: <br />
						<textarea name="entry" value="<?php echo $rowp['ENTRY']; ?>" rows="20" cols="80"></textarea>
					</p>
					<input type="submit" name="submit" value="Edit Log" />
		<?php } ?>
				</form>
				<br />
		<a href="logs.php">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_log.php" onclick="return confirm('Are you sure about deleting this?');">Delete Log</a>
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>