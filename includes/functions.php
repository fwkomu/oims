<?php require_once( "../includes/session.php" ); ?>
<?php
function redirect_to( $new_location ) {
	header( "Location: " . $new_location );
	exit;
}

function mysql_prep( $string ) {
	global $connection;

	$escaped_string = mysqli_real_escape_string( $connection, $string );

	return $escaped_string;
}

function confirm_query( $result_set ) {
	if ( ! $result_set ) {
		die( "Database query failed." );
	}
}

function confirm_query_v2( $result_set ) {
	if ($result_set ) {
		return true;
	}else {
		die( "Database query failed." );
	}
}


function form_errors( $errors = array() ) {
	$output = "";
	if ( ! empty( $errors ) ) {
		$output .= "<div class=\"error\">";
		$output .= "Please fix the following errors:";
		$output .= "<ul>";
		foreach ( $errors as $key => $error ) {
			$output .= "<li>";
			$output .= htmlentities( $error );
			$output .= "</li>";
		}
		$output .= "</ul>";
		$output .= "</div>";
	}

	return $output;
}

function find_all_subjects( $public = true ) {
	global $connection;

	$query = "SELECT * ";
	$query .= "FROM subjects ";
	if ( $public ) {
		$query .= "WHERE visible = 1 ";
	}
	$query       .= "ORDER BY position ASC";
	$subject_set = mysqli_query( $connection, $query );
	confirm_query( $subject_set );

	return $subject_set;
}

function find_pages_for_subject( $subject_id, $public = true ) {
	global $connection;

	$safe_subject_id = mysqli_real_escape_string( $connection, $subject_id );

	$query = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE subject_id = {$safe_subject_id} ";
	if ( $public ) {
		$query .= "AND visible = 1 ";
	}
	$query    .= "ORDER BY position ASC";
	$page_set = mysqli_query( $connection, $query );
	confirm_query( $page_set );

	return $page_set;
}

function find_all_admins() {
	global $connection;

	$query     = "SELECT * ";
	$query     .= "FROM users ";
	$query     .= "WHERE user_role = 'admin' ";
	$query     .= "ORDER BY username ASC";
	$admin_set = mysqli_query( $connection, $query );
	confirm_query( $admin_set );

	return $admin_set;
}

function find_all_students() {
	global $connection;

	$query       = "SELECT * ";
	$query       .= "FROM users ";
	$query       .= "WHERE user_role = 'student' ";
	$query       .= "ORDER BY username ASC";
	$student_set = mysqli_query( $connection, $query );
	confirm_query( $student_set );

	return $student_set;
}

function find_all_trainers() {
	global $connection;

	$query       = "SELECT * ";
	$query       .= "FROM users ";
	$query       .= "WHERE user_role = 'trainer' ";
	$query       .= "ORDER BY username ASC";
	$trainer_set = mysqli_query( $connection, $query );
	confirm_query( $trainer_set );

	return $trainer_set;
}

function find_all_supervisors() {
	global $connection;

	$query          = "SELECT * ";
	$query          .= "FROM users ";
	$query          .= "WHERE user_role = 'supervisor' ";
	$query          .= "ORDER BY username ASC";
	$supervisor_set = mysqli_query( $connection, $query );
	confirm_query( $supervisor_set );

	return $supervisor_set;
}

function find_subject_by_id( $subject_id, $public = true ) {
	global $connection;

	$safe_subject_id = mysqli_real_escape_string( $connection, $subject_id );

	$query = "SELECT * ";
	$query .= "FROM subjects ";
	$query .= "WHERE id = {$safe_subject_id} ";
	if ( $public ) {
		$query .= "AND visible = 1 ";
	}
	$query       .= "LIMIT 1";
	$subject_set = mysqli_query( $connection, $query );
	confirm_query( $subject_set );
	if ( $subject = mysqli_fetch_assoc( $subject_set ) ) {
		return $subject;
	} else {
		return null;
	}
}

function find_page_by_id( $page_id, $public = true ) {
	global $connection;

	$safe_page_id = mysqli_real_escape_string( $connection, $page_id );

	$query = "SELECT * ";
	$query .= "FROM pages ";
	$query .= "WHERE id = {$safe_page_id} ";
	if ( $public ) {
		$query .= "AND visible = 1 ";
	}
	$query    .= "LIMIT 1";
	$page_set = mysqli_query( $connection, $query );
	confirm_query( $page_set );
	if ( $page = mysqli_fetch_assoc( $page_set ) ) {
		return $page;
	} else {
		return null;
	}
}

function find_admin_by_username( $admin_username ) {
	global $connection;

	$safe_admin_username = mysqli_real_escape_string( $connection, $admin_username );

	$query     = "SELECT * ";
	$query     .= "FROM users ";
	$query     .= "WHERE username = '{$safe_admin_username}' ";
	$query     .= "LIMIT 1";
	$admin_set = mysqli_query( $connection, $query );
	confirm_query( $admin_set );
	if ( $admin = mysqli_fetch_assoc( $admin_set ) ) {
		return $admin;
	} else {
		return null;
	}
}

function find_student_by_username( $student_username ) {
	global $connection;

	$safe_student_username = mysqli_real_escape_string( $connection, $student_username );

	$query       = "SELECT * ";
	$query       .= "FROM users ";
	$query       .= "WHERE username = '{$safe_student_username}' ";
	$query       .= "LIMIT 1";
	$student_set = mysqli_query( $connection, $query );
	confirm_query( $student_set );
	if ( $student = mysqli_fetch_assoc( $student_set ) ) {
		return $student;
	} else {
		return null;
	}
}

function find_trainer_by_username( $trainer_username ) {
	global $connection;

	$safe_trainer_username = mysqli_real_escape_string( $connection, $trainer_username );

	$query       = "SELECT * ";
	$query       .= "FROM users ";
	$query       .= "WHERE username = {$safe_trainer_username} ";
	$query       .= "LIMIT 1";
	$trainer_set = mysqli_query( $connection, $query );
	confirm_query_v2( $trainer_set );
	if ( $trainer = mysqli_fetch_assoc( $trainer_set ) ) {
		return $trainer;
	} else {
		return null;
	}
}

function find_supervisor_by_username( $supervisor_username ) {
	global $connection;

	$safe_supervisor_username = mysqli_real_escape_string( $connection, $supervisor_username );

	$query          = "SELECT * ";
	$query          .= "FROM users ";
	$query          .= "WHERE username = '{$safe_supervisor_username}' ";
	$query          .= "LIMIT 1";
	$supervisor_set = mysqli_query( $connection, $query );
	confirm_query_v2($supervisor_set);
	if (!$supervisor_set){
		echo mysqli_error();
	}
	if ( $supervisor = mysqli_fetch_assoc( $supervisor_set ) ) {
		return $supervisor;
	} else {
		return null;
	}
}

function find_default_page_for_subject( $subject_id ) {
	$page_set = find_pages_for_subject( $subject_id );
	if ( $first_page = mysqli_fetch_assoc( $page_set ) ) {
		return $first_page;
	} else {
		return null;
	}
}

function find_selected_page( $public = false ) {
	global $current_subject;
	global $current_page;

	if ( isset( $_GET["subject"] ) ) {
		$current_subject = find_subject_by_id( $_GET["subject"], $public );
		if ( $current_subject && $public ) {
			$current_page = find_default_page_for_subject( $current_subject["id"] );
		} else {
			$current_page = null;
		}
	} else if ( isset( $_GET["page"] ) ) {
		$current_subject = null;
		$current_page    = find_page_by_id( $_GET["page"], $public );
	} else {
		$current_subject = null;
		$current_page    = null;
	}
}

//
function find_current_user( $username ) {
	global $current_username;

	if ( isset( $_SESSION["username"] ) ) {
		$current_username = $_SESSION["username"];
	} else {
		$current_username = null;
	}
}

//function not working to bring result
function retrieve_profile_data() {
	global $connection;
	global $profile_set;
	if ( isset( $_SESSION["username"] ) ) {
		$current_username = $_SESSION["username"];
	} else {
		$current_username = null;
	}

	$query = "SELECT * ";
	$query .= "FROM profile ";
	$query .= "WHERE username = '$current_username'";

	$profile_set = mysqli_query( $connection, $query );
	confirm_query( $profile_set );

	return $profile_set;
}

function retrieve_logs_data() {
	global $connection;
	global $profile_set;
	if ( isset( $_SESSION["username"] ) ) {
		$current_username = $_SESSION["username"];
	} else {
		$current_username = null;
	}

	$query = "SELECT * ";
	$query .= "FROM logs ";
	$query .= "WHERE DATE = '$current_username'";

	$profile_set = mysqli_query( $connection, $query );
	confirm_query( $profile_set );

	return $profile_set;
}

// navigation takes 2 arguments
// - the current subject array or null
// - the current page array or null
function navigation( $subject_array, $page_array ) {
	$output      = "<ul class=\"subjects\">";
	$subject_set = find_all_subjects( false );
	while ( $subject = mysqli_fetch_assoc( $subject_set ) ) {
		$output .= "<li";
		if ( $subject_array && $subject["id"] == $subject_array["id"] ) {
			$output .= " class=\"selected\"";
		}
		$output .= ">";
		$output .= "<a href=\"manage_content.php?subject=";
		$output .= urlencode( $subject["id"] );
		$output .= "\">";
		$output .= htmlentities( $subject["menu_name"] );
		$output .= "</a>";

		$page_set = find_pages_for_subject( $subject["id"], false );
		$output   .= "<ul class=\"pages\">";
		while ( $page = mysqli_fetch_assoc( $page_set ) ) {
			$output .= "<li";
			if ( $page_array && $page["id"] == $page_array["id"] ) {
				$output .= " class=\"selected\"";
			}
			$output .= ">";
			$output .= "<a href=\"manage_content.php?page=";
			$output .= urlencode( $page["id"] );
			$output .= "\">";
			$output .= htmlentities( $page["menu_name"] );
			$output .= "</a></li>";
		}

		mysqli_free_result( $page_set );
		$output .= "</ul></li>";
	}
	mysqli_free_result( $subject_set );
	$output .= "</ul>";

	return $output;
}

function public_navigation( $subject_array, $page_array ) {
	$output      = "<ul class=\"subjects\">";
	$subject_set = find_all_subjects();
	while ( $subject = mysqli_fetch_assoc( $subject_set ) ) {
		$output .= "<li";
		if ( $subject_array && $subject["id"] == $subject_array["id"] ) {
			$output .= " class=\"selected\"";
		}
		$output .= ">";
		$output .= "<a href=\"index.php?subject=";
		$output .= urlencode( $subject["id"] );
		$output .= "\">";
		$output .= htmlentities( $subject["menu_name"] );
		$output .= "</a>";

		if ( $subject_array["id"] == $subject["id"] || $page_array["subject_id"] == $subject["id"] ) {
			$page_set = find_pages_for_subject( $subject["id"] );
			$output   .= "<ul class=\"pages\">";
			while ( $page = mysqli_fetch_assoc( $page_set ) ) {
				$output .= "<li";
				if ( $page_array && $page["id"] == $page_array["id"] ) {
					$output .= " class=\"selected\"";
				}
				$output .= ">";
				$output .= "<a href=\"index.php?page=";
				$output .= urlencode( $page["id"] );
				$output .= "\">";
				$output .= htmlentities( $page["menu_name"] );
				$output .= "</a></li>";
			}
			$output .= "</ul>";
			mysqli_free_result( $page_set );
		}

		$output .= "</li>"; // end of subject <li>
	}
	mysqli_free_result( $subject_set );
	$output .= "</ul>";

	return $output;
}

function password_encrypt( $password ) {
	$hash_format     = "$2y$10$";    // Tells PHP to use Blowfish with a "cost" of 10
	$salt_length     = 22;            // Blowfish salts should be 22-characters or more
	$salt            = generate_salt( $salt_length );
	$format_and_salt = $hash_format . $salt;
	$hash            = crypt( $password, $format_and_salt );

	return $hash;
}

function generate_salt( $length ) {
	// Not 100% unique, not 100% random, but good enough for a salt
	// MD5 returns 32 characters
	$unique_random_string = md5( uniqid( mt_rand(), true ) );

	// Valid characters for a salt are [a-zA-Z0-9./]
	$base64_string = base64_encode( $unique_random_string );

	// But not '+' which is valid in base64 encoding
	$modified_base64_string = str_replace( '+', '.', $base64_string );

	// Truncate string to the correct length
	$salt = substr( $modified_base64_string, 0, $length );

	return $salt;
}

function password_check( $password, $existing_hash ) {
	// existing hash contains format and salt at start
	$hash = crypt( $password, $existing_hash );
	if ( $hash === $existing_hash ) {
		return true;
	} else {
		return false;
	}
}

function attempt_login( $username, $password ) {
	$admin = find_admin_by_username( $username );
	if ( $admin ) {
		// found admin, now check password
		if ( password_check( $password, $admin["hashed_password"] ) ) {
			// password matches
			return $admin;
		} else {
			// password does not match
			return false;
		}
	} else {
		// admin not found
		return false;
	}
}

function logged_in() {
	/* global $connection;

	$query = "SELECT user_role ";
	$query .= "FROM users;";
	$result = mysqli_query($connection, $query); */

	return isset( $_SESSION['username'] ); // initial code

	/* if ($user_role == 'student') {
		$redirect = 'student.php';
	} else if ($user_role == 'trainer') {
		$redirect = 'trainer.php';
	} else if ($user_role == 'supervisor') {
		$redirect = 'supervisor.php';
	} else if ($user_role == 'admin') {
		$redirect = 'admin.php';
	}
	redirect_to($redirect); */

}

function confirm_logged_in() {
	if ( ! isset( $_SESSION['username'] ) ) {
		redirect_to( "login.php" );
	}
}

function find_log_by_date( $log_date ) {
	global $connection;

	$safe_log_date = mysqli_real_escape_string( $connection, $log_date );

	$query   = "SELECT * ";
	$query   .= "FROM logs ";
	$query   .= "WHERE date = {$safe_log_date} ";
	$query   .= "LIMIT 1";
	$log_set = mysqli_query( $connection, $query );
	confirm_query( $log_set );
	if ( $log = mysqli_fetch_assoc( $log_set ) ) {
		return $log;
	} else {
		return null;
	}
}

function welcome_email( $too, $sub, $lusername, $lpassword ) {
	$subject = $sub;

	$to = $too;

	$message = "<h3></h3><p>Welcome to OIMS system. Below are your login details:<br/><br/><b>Username: </b> $lusername<br/><b>Password: </b> $lpassword<br/><br/>Thank you</p>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: Account Login Details <no-reply@itsphoenix.co.ke>' . "\r\n";

	if ( mail( $to, $subject, $message, $headers ) ) {
		return true;
	} else {
		return false;
	}
}

function rating_email( $too, $sub , $total) {
	$subject = $sub;

	$to = $too;

	$message = "<h3></h3><p>You were rated on our system. Your total score is:<br/><br/>$total<br/><br/>Thank you</p>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: Account Login Details <no-reply@itsphoenix.co.ke>' . "\r\n";

	if ( mail( $to, $subject, $message, $headers ) ) {
		return true;
	} else {
		return false;
	}
}

function supervision_email( $too, $sub, $lassigned_student, $lstudent_email, $ldate ) {
	$subject = $sub;

	$to = $too;

	$message = "<h3></h3><p>Hello there. Below are your supervision details:<br/><br/><b>Student: </b> $lassigned_student<br/><b>Student Email: </b> $lstudent_email<br/><b>Supervision Date: </b> $ldate<br/><br/>Thank you</p>";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: Supervision Schedule Details <no-reply@itsphoenix.co.ke>' . "\r\n";

	if ( mail( $to, $subject, $message, $headers ) ) {
		return true;
	} else {
		return false;
	}
}

// getRateMarks() finds the price based on the size of the cake.
// Here, we need to take user's selection from radio button selection
/*function getRateMarks()
{
	var rate_marks = new Array();
	rate_marks["doc1"]=1;
	rate_marks["doc2"]=2;
	rate_marks["doc3"]=3;
	rate_marks["doc4"]=4;
	rate_marks["doc5"]=5;

	var RateMarks=0;
	//Get a reference to the form id="rate"
	var theForm = document.forms["rate"];
	//Get a reference to the cake the user Chooses name=selectedButton":
	var selectedButton = theForm.elements["documentation"];
	//Here since there are 5 radio buttons selectedButton.length = 5
	//We loop through each radio buttons
	for(var i = 0; i < selectedButton.length; i++)
	{
		//if the radio button is checked
		if(selectedButton[i].checked)
		{
			//we set RateMarks to the value of the selected radio button
			//i.e. if the user choose the 5" doc we set it to 5
			//by using the rate_marks array
			//We get the selected Items value
			//For example rate_marks["doc5".value]"
			RateMarks = rate_marks[documentation[i].value];
			//If we get a match then we break out of this loop
			//No reason to continue if we get a match
			break;
		}
	}
	//We return the RateMarks
	return RateMarks;
}

function getTotal()
{
	//Here we get the total price by calling our function
	//Each function returns a number so by calling them we add the values they return together
	var rate_marks = getRateMarks();

	//display the result
	document.getElementById('totalPrice').innerHTML =
									  "Total Marks for Student $"+rate_marks;

} */

?>