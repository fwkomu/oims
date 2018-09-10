<!--functionality that allows admin to schedule supervisors that will-->
<!--visit students at place of attachment. Checks the supervisors in database and assigns*/-->

<?php require_once( "../includes/session.php" ); ?>
<?php require_once( "../includes/db_connection.php" ); ?>
<?php require_once( "../includes/functions.php" ); ?>
<?php require_once( "../includes/validation_functions.php" ); ?>

<?php
$layout_context = "admin";
/*
 * Fetch supervisors
 */
$supervisor_set = find_all_supervisors();

/*
 * Fetch students
 */
$student_set = find_all_students();


/*
 * Save schedule
 */
if ( isset( $_POST['submit'] ) ) {
	//Process the form

	// validations
	$required_fields = array( "supervisor", "student", "supervision_date" );
	validate_presences( $required_fields );

	if ( empty( $errors ) ) {
		/*
		 * Fetch instance data for student & supervisor
		 */
		$supervisor_data = find_supervisor_by_username( $_POST["supervisor"] );
		$student_data    = find_student_by_username( $_POST["student"] );

		/*
		 * Call required fields form instance objects
		 */
		$supervisor_username = mysql_prep( $supervisor_data["username"] );
		$supervisor_email    = mysql_prep( $supervisor_data["email"] );
		$student_username    = mysql_prep( $student_data["username"] );
		$student_email       = mysql_prep( $student_data["email"] );
		$supervision_date    = mysql_prep( $_POST["supervision_date"] );

		$query  = "INSERT INTO schedule (";
		$query  .= " username, email, assigned_student, student_email, supervision_date";
		$query  .= ") VALUES (";
		$query  .= " '{$supervisor_username}', '{$supervisor_email}', '{$student_username}', '{$student_email}', '{$supervision_date}'";
		$query  .= ")";
		$result = mysqli_query( $connection, $query );

		if ( $result ) {
			/*
			 * Mail supervisor
			 */
			$_SESSION["message"] = "Supervisor assigned successfully.";
			if ( supervision_email($supervisor_email, "Supervision", $student_username, $student_email, $supervision_date) ) {
				redirect_to( "schedule.php" );
			} else {
				//Email failure
				$_SESSION["message"] = "Dummy email failure.";
			}
		} else {
			//Failure
			$_SESSION["message"] = "Failed. Try again";
		}
	}
} else {
	// This is probably a GET request

} // end: if (isset($_POST['submit']))
?>
<?php include( "../includes/layouts/header.php" ); ?>
<div id="main">
    <div id="navigation">
        <br/>
        <a href="admin.php">&laquo; Main menu</a><br/>
    </div>
    <div id="page">
		<?php echo message(); ?>
		<?php echo form_errors( $errors ); ?>

        <h2>Assign Supervisor</h2>
        <form action="schedule.php" method="POST">
            <p>Supervisor:
                <select name="supervisor" required>
                    <option disabled selected>Select a supervisor</option>
					<?php while ( $supervisor = mysqli_fetch_assoc( $supervisor_set ) ) { ?>
                        <option value="<?= $supervisor['username'] ?>"><?= $supervisor['username'] ?></option>
					<?php } ?>
                </select>
            </p>
            <p>Student:
                <select name="student" required>
                    <option disabled selected>Select a student</option>
					<?php while ( $student = mysqli_fetch_assoc( $student_set ) ) { ?>
                        <option value="<?= $student['username'] ?>"><?= $student['username'] ?></option>
					<?php } ?>
                </select>
            </p>
            <p>Date:
                <input type="date" name="supervision_date" required>
            </p>
            <input type="submit" name="submit" value="Assign Supervisor"/>
        </form>

    </div>
</div>


<?php include( "../includes/layouts/footer.php" ); ?>