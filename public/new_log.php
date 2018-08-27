<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
	if (isset($_POST['submit'])) {
		//Process the form
		
		// validations
		$required_fields = array("date", "entry");
		validate_presences($required_fields);
		
		if (empty($errors)) {
			// Perform Create
			$username = find_current_user("username");
			$date = mysql_prep($_POST["date"]);
			$entry = mysql_prep($_POST["entry"]);
			
			$query = "INSERT INTO logs (";
			$query .= " username, date, entry";
			$query .= ") VALUES (";
			$query .= " '{$username}', '{$date}', '{$entry}'";
			$query .= ")";
			$result = mysqli_query($connection, $query);
			
			if($result){
				//Success
				$_SESSION["message"] = "Log created.";
				//redirect_to("");
			} else {
				//Failure
				$_SESSION["message"] = "Log creation failed";
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
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>Daily Logs Management</h2>
		<form action="new_log.php" method = "POST">
			<?php $today = date("Y-m-d"); ?>
			<input type="date" name="date" value="<?php echo $today; ?>" />
		
			<p>
			Notes on work done: <br />
				<textarea name="entry" placeholder="Provide a detailed report of the day's activity" rows="20" cols="80"></textarea>
			</p>
			<input type="submit" name="submit" value="Submit" />
		</form>
		<br />
		<a href="">Cancel</a>
	</div>
</div>

<script src="air-datepicker/js/datepicker.min.js"></script>
<script src="air-datepicker/js/i18n/datepicker.en.js"></script>
<?php include("../includes/layouts/footer.php"); ?>