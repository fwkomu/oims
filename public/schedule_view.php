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
						while ( $schedule_view = mysqli_fetch_assoc( $result ) ) {
							$supervisor_details = find_supervisor_by_username($schedule_view['username']);
						    $student_details = find_student_by_username($schedule_view['assigned_student']);
						    ?>
                            <tr>
                                <td><?= $schedule_view["username"] ?></td>
                                <td><?= $supervisor_details['email'] ?></td>
                                <td><?= $schedule_view["assigned_student"] ?></td>
                                <td><?= $student_details['email'] ?></td>
                                <td><?= $schedule_view['supervision_date'] ?></td>
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