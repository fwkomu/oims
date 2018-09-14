<?php require_once( "../includes/session.php" ); ?>
<?php require_once( "../includes/db_connection.php" ); ?>
<?php require_once( "../includes/functions.php" ); ?>
<?php require_once( "../includes/validation_functions.php" ); ?>
<?php $layout_context = "student"; ?>
<?php include( "../includes/layouts/header.php" ); ?>

<?php
/*
 * Fetch supervisors
 */
$supervisor_set = find_all_supervisors();
/*
 * Fetch students
 */
$student_set = find_all_students();


if ( isset( $_GET['submit'] ) ) {
	//Process the form

	if ( empty( $errors ) ) {

		/*
		 * Get schedule entries
		 */
		$username = mysql_prep( $_GET["username"] );
		$email = mysql_prep( $_GET["email"] );
		$assigned_student = mysql_prep( $_GET["assigned_student"] );
		$student_email = mysql_prep( $_GET["student_email"] );
		$supervision_date = mysql_prep( $_GET['date'] );

		// SELECT entry FROM schedule
		$query = "SELECT * FROM schedule ";

		$result = mysqli_query( $connection, $query );

		if ( $result ) {
			//Success
			if ( mysqli_num_rows( $result ) <= 0 ) {
				$result              = false;
				$_SESSION["message"] = "No schedule available.";
			} else {

				$_SESSION["message"] = "Schedule retrieved.";
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
            <a href="#">&laquo; Main menu</a><br/>
        </div>
        <div id="page">
			<?php echo message(); ?>
			<?php echo form_errors( $errors ); ?>

			<h2>Schedule for Supervision</h2>
            <form action="schedule_view.php" method="GET">
			<input type="submit" name="submit" value="Retrieve schedule"/>
			</br>
                <table>
                    <tr>
                        <th style="text-align: left; width: 200px;">Supervisor</th>
                        <th style="text-align: left; width: 200px;">Supervisor Email</th>
                        <th style="text-align: left; width: 200px;">Assigned Student</th>
                        <th style="text-align: left; width: 200px;">Student Email</th>
						<th style="text-align: left; width: 200px;">Supervision Date</th>
                    </tr>
					<?php
					if ( $result ) {
						while ( $schedule_view = mysqli_fetch_assoc( $result ) ) { ?>
                            <tr>
                                <td><?= $schedule["username"] ?></td>
                                <td><?= $schedule['DATE'] ?></td>
                                <td><?= $schedule['ENTRY'] ?></td>
                            </tr>
						<?php } ?>
						<?php
					} else {
						?>
                        <tr>
                            <td colspan="3">No schedule created. Kindly contact the admin.</td>
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