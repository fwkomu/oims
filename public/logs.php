<?php require_once( "../includes/session.php" ); ?>
<?php require_once( "../includes/db_connection.php" ); ?>
<?php require_once( "../includes/functions.php" ); ?>
<?php require_once( "../includes/validation_functions.php" ); ?>
<?php $layout_context = "student"; ?>
<?php include( "../includes/layouts/header.php" ); ?>

<?php
if ( isset( $_POST['submit'] ) ) {
	//Process the form

	// validations
	$required_fields = array( "date_from", "date_to" );
	validate_presences( $required_fields );

	if ( empty( $errors ) ) {
		// Perform Create

		$date_from = mysql_prep( $_GET["date_from"] );
		$date_to   = mysql_prep( $_GET["date_to"] );
		$entry     = mysql_prep( $_GET["entry"] );

		// SELECT entry FROM logs
		$query = "SELECT * FROM logs ";
		$query .= "WHERE DATE >= '" . $date_from . "' AND DATE <= '" . $date_to . "'";

		$result = mysqli_query( $connection, $query );

		if ( $result ) {
			//Success
			if (mysqli_num_rows($result) <= 0){
			    $result = false;
				$_SESSION["message"] = "No logs retrieved.";
            } else{

				$_SESSION["message"] = "Logs retrieved.";
            }
			//redirect_to("");
		} else {
			//Failure
			$_SESSION["message"] = "Log retrival failed";
		}
	}
} else {
	// This is probably a GET request
	$result = false;

} // end: if (isset($_POST['submit']))
?>

    <div id="main">
        <div id="navigation">
            <br/>
            <a href="#">&laquo; Main menu</a><br/>
        </div>
        <div id="page">
			<?php echo message(); ?>
			<?php echo form_errors( $errors ); ?>

            <h2>View logs</h2>
            <form action="logs.php" method="GET">
				<?php $today = date( "Y-m-d" ); ?>
                <label>From</label>
                <input type="date" name="date_from" value="<?php echo $today; ?>"/>
                <label>To</label>
                <input type="date" name="date_to" value="<?php echo $today; ?>"/>
                <input type="submit" name="submit" value="Filter"/>


                <h2>Logs</h2>
                <table>
                    <tr>
                        <th style="text-align: left; width: 200px;">Username</th>
                        <th style="text-align: left; width: 200px;">Date</th>
                        <th colspan="2" style="text-align: left;">Entry</th>
                    </tr>
					<?php
					if ( $result ) {
						while ( $log = mysqli_fetch_assoc( $result ) ) { ?>
                            <tr>
                                <td><?= $log["username"] ?></td>
                                <td><?= $log['DATE'] ?></td>
                                <td><?= $log['ENTRY'] ?></td>
                            </tr>
						<?php } ?>
						<?php
					} else {
?>
                        <tr>
                            <td colspan="3">No logs for the selected date range.</td>
                        </tr>
                        <?php
					}
					?>
                </table>
                <br/>

                <p>
                    Notes on work done: <br/>
                    <textarea name="entry" placeholder="" rows="20" cols="80"></textarea>
                </p>
            </form>
            <br/>

            <a href="">Cancel</a>

        </div>
    </div>
<?php include( "../includes/layouts/footer.php" ); ?>