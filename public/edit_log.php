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
			$query = "UPDATE logs SET ";
			$query .= "ENTRY = '{$entry}' ";
			$query .= "WHERE DATE = '{$date}' AND username='{$current_username}'";
			$query .= "LIMIT 1";
			$result = mysqli_query($connection, $query);

			$log = find_log_by_user($current_username, $date);

			
			if($result && mysqli_affected_rows($connection) >= 0) {
				//Success
				$_SESSION["message"] = "Log updated.";
				redirect_to("logs.php");

			} else {
				//Failure
				$log = ['ENTRY'=>"No log"];
				$message = "Log update failed.";

			}
		}
	} elseif (isset($_GET['submit_get'])) {
		//Process the form

		$date = mysql_prep($_GET["fetch_date"]);

		// validations
		$required_fields = array("fetch_date",);
		validate_get_presences($required_fields);

		if (empty($errors)) {
		    $log = find_log_by_user($current_username, $date);
		    if ($log == null){
			    $log = ['ENTRY'=>"No log for this date"];
            }
		} else{
			$log = ['ENTRY'=>"No log date"];
        }
	} else {
		$log = ['ENTRY'=>"No log"];
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
        <form action="edit_log.php" method="GET">
            <input type="date" name="fetch_date" value="<?php if (isset($_GET['fetch_date'])){echo $_GET['fetch_date'];} ?>" />
            <input type="submit" name="submit_get" value="Retrieve" />
        </form>
				<form action="edit_log.php" method="POST">
                    <input type="hidden" name="date" value="<?php if (isset($_GET['fetch_date'])){echo $_GET['fetch_date'];} ?>" />
					<p>
					Notes on work done: <br />
						<textarea name="entry" value="<?= $log['ENTRY']; ?>" rows="10" cols="80"><?= $log['ENTRY']; ?></textarea>
					</p>
					<input type="submit" name="submit" value="Edit Log" />
		<?php } ?>
				</form>
				<br />
		<a href="logs.php">Cancel</a>
		&nbsp;
		&nbsp;
		<a href="delete_log.php?fetch_date=<?php if (isset($_GET['fetch_date'])){echo $_GET['fetch_date'];} ?>" onclick="return confirm('Are you sure about deleting this?');">Delete Log</a>
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>