<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>
<?php $layout_context = "student"; ?>
<?php include("../includes/layouts/header.php"); ?>

<?php
	if (isset($_POST['submit'])) {
		//Process the form
		
		// validations
		$required_fields = array("date");
		validate_presences($required_fields);
		
		if (empty($errors)) {
			// Perform Create

			$date = mysql_prep($_POST["date"]);
			$entry = mysql_prep($_POST["entry"]);
		
			$query = "SELECT entry FROM logs ";
			$query .= "WHERE date = ";
			$result = mysqli_query($connection, $query);
			
			if($result){
				//Success
				$_SESSION["message"] = "Log retrieved.";
				//redirect_to("");
			} else {
				//Failure
				$_SESSION["message"] = "Log retrival failed";
			}
		}
	} else {
		// This is probably a GET request
		
	} // end: if (isset($_POST['submit']))
?>

<div id="main">
	<div id="navigation">
		<br />
		<a href="#">&laquo; Main menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>View logs</h2>
		<form action="logs.php" method = "POST">
			<?php $today = date("Y-m-d"); ?>
			<input type="date" name="date" value="<?php echo $today; ?>" />
			<input type="submit" name="submit" value="Submit" />
			<p>
			Notes on work done: <br />
				<textarea name="entry" placeholder="" rows="20" cols="80"></textarea>
			</p>
		</form>
		<br />
		<a href="">Cancel</a>
		
	</div>
</div>
<?php include("../includes/layouts/footer.php"); ?>