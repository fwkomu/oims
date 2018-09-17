<?php require_once( "../includes/session.php" ); ?>
<?php require_once( "../includes/db_connection.php" ); ?>
<?php require_once( "../includes/functions.php" ); ?>
<?php require_once( "../includes/validation_functions.php" ); ?>

<?php $layout_context = "student"; ?>
<?php
include( "../includes/layouts/header.php" );

/*
 * Fetch students
 */
$student_set = find_all_students();


if ( isset( $_GET['submit'] ) ) {
	//Process the form
	// validations
	$required_fields = array( "student" );
	validate_get_presences( $required_fields );

	if ( empty( $errors ) ) {

		/*
		 * Retrieve Ratings
		 */
		$student_data = find_student_by_username( $_GET["student"] );

		
		$student_picked = mysql_prep( $_GET["student"] );

		// SELECT entry FROM rating
		$query = "SELECT * FROM rating ";
		$query .= "WHERE username='" . $student_picked . "'";

		$result = mysqli_query( $connection, $query );

		if ( $result ) {
			//Success
			if ( mysqli_num_rows( $result ) <= 0 ) {
				$result              = false;
				$_SESSION["message"] = "No ratings retrieved.";
			} else {

				$_SESSION["message"] = "Ratings retrieved.";
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
		<br />
		<a href="supervisor.php">&laquo; Main menu</a><br /><br />
            &nbsp;
        </div>
        <div id="page">
			<?php echo message(); ?>
			<?php echo form_errors( $errors ); ?>

            <h2>RATINGS/ASSESSMENT</h2>
            <form action="ratings_view_sup.php" id="rate_view" method="GET">
                <label>Select Student</label>
                <select name="student" required>
                    <option disabled selected>Select a student</option>
					<?php while ( $student = mysqli_fetch_assoc( $student_set ) ) { ?>
                        <option value="<?= $student['username'] ?>"><?= $student['username'] ?></option>
					<?php } ?>
                </select>
				<input type="submit" name="submit" value="View Ratings"/>
                <table id="rate_view" width="90%" cellpadding="5">
                    <thead>
                    <tr>
                        <th rowspan="2" colspan="2"><h3>ASSESSMENT AREAS</h3></th>
                        <th colspan="5"><h3>RATING SCALE</h3></th>
                    </tr>
                    <tr>
                        <th>Points attained by Student</th>
                    </tr>
                    </thead>
                    <tbody>
					
					<?php
					if ( $result ) {
						while ( $rating = mysqli_fetch_assoc( $result ) ) { ?>
				
                    <tr>
                        <td>1.</td>
                        <td>Availability of required documentation (5)</td>
                        <td colspan="5"><?= $rating['documentation'] ?></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Degree of organization of daily entries in internship system (10)</td>
                        <td><?= $rating['organization'] ?></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Level of adaptability of attachee in the organization/institution (10)</td>
                        <td><?= $rating['adaptability'] ?></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Ability to work in teams (10)</td>
                        <td><?= $rating['teamwork'] ?></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Accomplishment of assignments (10)</td>
						<td><?= $rating['assignments'] ?></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Presence at designated areas (10)</td>
						<td><?= $rating['presence'] ?></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Communication skills (10)</td>
						<td><?= $rating['communication'] ?></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>Mannerism (10)</td>
						<td><?= $rating['mannerism'] ?></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>Student understanding of assignments/tasks given (15)</td>
                        <td><?= $rating['understanding'] ?></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Oral presentation (10)</td>
						<td><?= $rating["oral"] ?></td>
                    </tr>
					<tr>
                        <td>11.</td>
                        <td>TOTAL points out of 100</td>
						<td><?= $rating["total"] ?></td>
                    </tr>
					<tr>
                        <td>12.</td>
                        <td>DATE</td>
						<td><?= $rating['date'] ?></td>
                    </tr>
					<tr>
                        <td>13.</td>
                        <td>Rated by</td>
						<td><?= $rating["rated_by"] ?></td>
                    </tr>
					<tr>
                        <td>14.</td>
                        <td>Comments</td>
						<td><?= $rating['comments'] ?></td>
                    </tr>
					
						<?php } ?>
						<?php
					} else {
						?>
                        <tr>
                            <td colspan="3">No ratings for the selected student.</td>
                        </tr>
						<?php
					}
					?>
                    </tbody>
                </table>
				<br/>
				
            </form>
        </div>
    </div>

<?php include( "../includes/layouts/footer.php" ); ?>