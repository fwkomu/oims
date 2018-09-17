<?php require_once( "../includes/session.php" ); ?>
<?php require_once( "../includes/db_connection.php" ); ?>
<?php require_once( "../includes/functions.php" ); ?>
<?php require_once( "../includes/validation_functions.php" ); ?>

<?php $layout_context = "admin"; ?>
<?php
include( "../includes/layouts/header.php" );


/*
 * Fetch students
 */
$student_set = find_all_students();


/*
 * Send accessment
 */
if ( isset( $_POST['submit'] ) ) {

	function calculate( $value, $total ) {
	    $tr = ( $value / 5 ) * $total;
		return $tr;
	}

	//Process the form
	// validations
	$required_fields = array(
		"student",
		"comments"
	);
	validate_presences( $required_fields );
	validate_radio_presences(array(
		"documentation",
		"organization",
		"adaptability",
		"teamwork",
		"assignments",
		"presence",
		"communication",
		"mannerism",
		"understanding",
		"oral"));

	if ( empty( $errors ) ) {
		// Perform Create

		/*
		 * Fetch instance data for student
		 */
		$student_data = find_student_by_username( $_POST["student"] );

		$student       = mysql_prep( $_POST["student"] );
		$comments      = mysql_prep( $_POST["comments"] );
		$documentation = calculate( mysql_prep( $_POST["documentation"] ), 5 );
		$organization  = calculate( mysql_prep( $_POST["organization"] ), 10 );
		$adaptability  = calculate( mysql_prep( $_POST["adaptability"] ), 10 );
		$teamwork      = calculate( mysql_prep( $_POST["teamwork"] ), 10 );
		$assignments   = calculate( mysql_prep( $_POST["assignments"] ), 10 );
		$presence      = calculate( mysql_prep( $_POST["presence"] ), 10 );
		$communication = calculate( mysql_prep( $_POST["communication"] ), 10 );
		$mannerism     = calculate( mysql_prep( $_POST["mannerism"] ), 10 );
		$understanding = calculate( mysql_prep( $_POST["understanding"] ), 15 );
		$oral          = calculate( mysql_prep( $_POST["oral"] ), 10 );

		$total_rating = $documentation + $organization + $adaptability + $teamwork + $assignments + $presence + $communication + $mannerism + $understanding + $oral;

		/*
		 * //Done
		 * Fetch and assign session user to rated_by
		 */
		$date_today = date( "Y-m-d" );

		$query  = "INSERT INTO rating (";
		$query  .= " username, documentation, organization, adaptability,teamwork,assignments,presence,communication,mannerism,understanding,oral,total, comments, rated_by, date";
		$query  .= ") VALUES (";
		$query  .= " '{$student}', '{$documentation}', '{$organization}', '{$adaptability}', '{$teamwork}', '{$assignments}', '{$presence}', '{$communication}', '{$mannerism}', '{$understanding}', '{$oral}', '{$total_rating}', '{$comments}', '{$_SESSION["username"]}', '{$date_today}'";
		$query  .= ")";
		$result = mysqli_query( $connection, $query );

		if ( $result ) {
			//Success
			$_SESSION["message"] = "Student rated at " . $total_rating;
			if ( rating_email( $student_data['email'], "Rating avg. ".$total_rating, $total_rating ) ) {
				redirect_to( "ratings.php" );
			} else {
				//Email failure
				$_SESSION["message"] = "Student rated but rating email failed.";
			}
		} else {
			//Failure
			$_SESSION["message"] = "Student rating failed. Error: ". mysqli_error($connection);
		}
	}
} else {
	// This is probably a GET request
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
            <form action="ratings.php" id="rate" method="POST">
                <label>Select Student</label>
                <select name="student" required>
                    <option disabled selected>Select a student</option>
					<?php while ( $student = mysqli_fetch_assoc( $student_set ) ) { ?>
                        <option value="<?= $student['username'] ?>"><?= $student['username'] ?></option>
					<?php } ?>
                </select>
                <table id="rate" width="90%" cellpadding="5">
                    <thead>
                    <tr>
                        <th rowspan="2" colspan="2"><h3>ASSESSMENT AREAS</h3></th>
                        <th colspan="5"><h3>RATING SCALE</h3></th>
                    </tr>
                    <tr>
                        <th>Poor</th>
                        <th>Below-Average</th>
                        <th>Average</th>
                        <th>Good</th>
                        <th>Excellent</th>
                    </tr>
                    </thead>
                    <tbody>
					<?php /*
						if ($rowp['value'] == 1) {
							$poor = 'checked';
						} else if ($rowp['value'] == 2) {
							$belowavg = 'checked';
						} else if ($rowp['value'] == 3) {
							$avg = 'checked';
						} else if ($rowp['value'] == 4) {
							$good = 'checked';
						} else if ($rowp['value'] == 5) {
							$excellent = 'checked';
						} */
					?>
                    <tr>
                        <td>1.</td>
                        <td>Availability of required documentation (5)</td>
                        <td align="center"><input type="radio" name="documentation" value="1"></td>
                        <td align="center"><input type="radio" name="documentation" value="2"></td>
                        <td align="center"><input type="radio" name="documentation" value="3"></td>
                        <td align="center"><input type="radio" name="documentation" value="4"></td>
                        <td align="center"><input type="radio" name="documentation" value="5"></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Degree of organization of daily entries in internship system (10)</td>
                        <td align="center"><input type="radio" name="organization" value="1"></td>
                        <td align="center"><input type="radio" name="organization" value="2"></td>
                        <td align="center"><input type="radio" name="organization" value="3"></td>
                        <td align="center"><input type="radio" name="organization" value="4"></td>
                        <td align="center"><input type="radio" name="organization" value="5"></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Level of adaptability of attachee in the organization/institution (10)</td>
                        <td align="center"><input type="radio" name="adaptability" value="1"></td>
                        <td align="center"><input type="radio" name="adaptability" value="2"></td>
                        <td align="center"><input type="radio" name="adaptability" value="3"></td>
                        <td align="center"><input type="radio" name="adaptability" value="4"></td>
                        <td align="center"><input type="radio" name="adaptability" value="5"></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Ability to work in teams (10)</td>
                        <td align="center"><input type="radio" name="teamwork" value="1"></td>
                        <td align="center"><input type="radio" name="teamwork" value="2"></td>
                        <td align="center"><input type="radio" name="teamwork" value="3"></td>
                        <td align="center"><input type="radio" name="teamwork" value="4"></td>
                        <td align="center"><input type="radio" name="teamwork" value="5"></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Accomplishment of assignments (10)</td>
                        <td align="center"><input type="radio" name="assignments" value="1"></td>
                        <td align="center"><input type="radio" name="assignments" value="2"></td>
                        <td align="center"><input type="radio" name="assignments" value="3"></td>
                        <td align="center"><input type="radio" name="assignments" value="4"></td>
                        <td align="center"><input type="radio" name="assignments" value="5"></td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Presence at designated areas (10)</td>
                        <td align="center"><input type="radio" name="presence" value="1"></td>
                        <td align="center"><input type="radio" name="presence" value="2"></td>
                        <td align="center"><input type="radio" name="presence" value="3"></td>
                        <td align="center"><input type="radio" name="presence" value="4"></td>
                        <td align="center"><input type="radio" name="presence" value="5"></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Communication skills (10)</td>
                        <td align="center"><input type="radio" name="communication" value="1"></td>
                        <td align="center"><input type="radio" name="communication" value="2"></td>
                        <td align="center"><input type="radio" name="communication" value="3"></td>
                        <td align="center"><input type="radio" name="communication" value="4"></td>
                        <td align="center"><input type="radio" name="communication" value="5"></td>
                    </tr>
                    <tr>
                        <td>8.</td>
                        <td>Mannerism (10)</td>
                        <td align="center"><input type="radio" name="mannerism" value="1"></td>
                        <td align="center"><input type="radio" name="mannerism" value="2"></td>
                        <td align="center"><input type="radio" name="mannerism" value="3"></td>
                        <td align="center"><input type="radio" name="mannerism" value="4"></td>
                        <td align="center"><input type="radio" name="mannerism" value="5"></td>
                    </tr>
                    <tr>
                        <td>9.</td>
                        <td>Student understanding of assignments/tasks given (15)</td>
                        <td align="center"><input type="radio" name="understanding" value="1"></td>
                        <td align="center"><input type="radio" name="understanding" value="2"></td>
                        <td align="center"><input type="radio" name="understanding" value="3"></td>
                        <td align="center"><input type="radio" name="understanding" value="4"></td>
                        <td align="center"><input type="radio" name="understanding" value="5"></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Oral presentation (10)</td>
                        <td align="center"><input type="radio" name="oral" value="1"></td>
                        <td align="center"><input type="radio" name="oral" value="2"></td>
                        <td align="center"><input type="radio" name="oral" value="3"></td>
                        <td align="center"><input type="radio" name="oral" value="4"></td>
                        <td align="center"><input type="radio" name="oral" value="5"></td>
                    </tr>


                    <tr>
                        <div id="totalPrice"></div>
                        <!--<td></td><td align="center">TOTAL</td><td colspan="5"><input type="text" name="total" value="" /></td>-->
                    </tr>
                    <tbody>
                </table>
                <label>Comments</label>
                <textarea name="comments"></textarea>
                <br/>
                <input type="submit" name="submit" value="Submit Rating">
            </form>
        </div>
    </div>

<?php //include("javascripts/calculate.js"); ?>
<?php include( "../includes/layouts/footer.php" ); ?>