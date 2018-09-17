<?php require_once( "../includes/session.php" ); ?>
<?php require_once( "../includes/db_connection.php" ); ?>
<?php require_once( "../includes/functions.php" ); ?>
<?php require_once( "../includes/validation_functions.php" ); ?>
<?php $layout_context = "student"; ?>
<?php include( "../includes/layouts/header.php" ); ?>

<?php

/*
 * Fetch students
 */
$student_set = find_all_students();

/*
 * Filter logs
 */
if ( isset( $_GET['submit'] ) ) {
	//Process the form

	// validations
	$required_fields = array( "date_from", "date_to", "student" );
	validate_get_presences( $required_fields );

	if ( empty( $errors ) ) {

		/*
		 * Filter logs
		 */
		$date_from      = mysql_prep( $_GET["date_from"] );
		$date_to        = mysql_prep( $_GET["date_to"] );
		$student_picked = mysql_prep( $_GET["student"] );

		// SELECT entry FROM logs
		$query = "SELECT * FROM logs ";
		$query .= "WHERE username='" . $student_picked . "' AND DATE >= '" . $date_from . "' AND DATE <= '" . $date_to . "'";

		$result = mysqli_query( $connection, $query );

		if ( $result ) {
			//Success
			if ( mysqli_num_rows( $result ) <= 0 ) {
				$result              = false;
				$_SESSION["message"] = "No logs retrieved.";
			} else {

				$_SESSION["message"] = "Logs retrieved.";
			}
			//redirect_to("");
		} else {
			//Failure
			$_SESSION["message"] = mysqli_error($connection);
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
            <a href="supervisor.php">&laquo; Main menu</a><br/>
        </div>
        <div id="page">
			<?php echo message(); ?>
			<?php echo form_errors( $errors ); ?>

            <h2>View logs</h2>
            <form action="logs_sup.php" method="GET">
				<?php
				/*
				 * Validate previous filter
				 */

				// date_from
				if ( isset($_GET['date_from']) ) {
					$date_from_default = $_GET['date_from'];
				} else {
					$date_from_default = date( "Y-m-d" );
				}
				// date_to
				if ( isset($_GET['date_to']) ) {
					$date_to_default = $_GET['date_to'];
				} else {
					$date_to_default = date( "Y-m-d" );
				}
				// student
				if ( isset($_GET['student']) ) {
					$student_default = $_GET['student'];
				} else {
					$student_default = false;
				}

				?>
                <label>Student</label>
                <select name="student" required>
                    <option disabled selected>Select a student</option>
					<?php while ( $student = mysqli_fetch_assoc( $student_set ) ) { ?>
                        <option <?php if ($student_default == $student['username']) echo 'selected' ?> value="<?= $student['username'] ?>"><?= $student['username'] ?></option>
					<?php } ?>
                </select>
                <label>From</label>
                <input type="date" name="date_from" value="<?php echo $date_from_default; ?>"/>
                <label>To</label>
                <input type="date" name="date_to" value="<?php echo $date_to_default; ?>"/>
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
            </form>
            <br/>

        </div>
    </div>
<?php include( "../includes/layouts/footer.php" ); ?>