<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
logged_in();
$username = "";
$user_role = "";

	if (isset($_POST['submit'])) {
		//Process the form
		
		// validations
		$required_fields = array("username", "password");
		validate_presences($required_fields);
		
		/* // Get $user_role
		$query = "SELECT user_role FROM users;";
		$result = mysqli_query($connection, $query);
		$resultcheck = mysqli_num_rows($result);
		
		if ($resultcheck > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
					
			// Redirection based on user_roles
			if ($user_role == 'student') {
				$redirect = 'student.php';
			} else if ($user_role == 'trainer') {
				$redirect = 'trainer.php';
			} else if ($user_role == 'supervisor') {
				$redirect = 'supervisor.php';
			} else if ($user_role == 'admin') {
				$redirect = 'admin.php';
			}
			redirect_to($redirect);
			}
		} */
		
		if (empty($errors)) {
			// Attempt Login 
			
			$username = $_POST["username"];
			$password = $_POST["password"];
			
			$found_login = attempt_login($username, $password);
			
			if($found_login){
				// Success
				// Mark user as logged in
				//$_SESSION["admin_id"] = $found_login["id"];
				$_SESSION["username"] = $found_login["username"];
				
			$query = "SELECT user_role FROM users WHERE username = '" . $_SESSION["username"] . "';";
            $result = mysqli_query($connection, $query);
            $resultcheck = mysqli_num_rows($result);
            $profilecheck = retrieve_profile_data();

            if ($resultcheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $user_role = $row['user_role'];
                    // Redirection based on user_roles
                    if ($user_role == 'student') {
                        $redirect = 'student.php';
                    } else if ($user_role == 'trainer') {
                        $redirect = 'trainer.php';
                    } else if ($user_role == 'supervisor') {
                        $redirect = 'supervisor.php';
                    } else if ($user_role == 'admin') {
                        $redirect = 'admin.php';
                    }
                }
            }
            redirect_to($redirect);
			} else {
				//Failure
				$_SESSION["message"] = "Username/Password not found.";
			}
		}
	} else {
		// This is probably a GET request
		
	} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = ""; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page" align="center">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<div id="login">
			<h2>Online Internship Management System Login</h2><br />
			<form action="login.php" method = "POST">
				<p>Username: &nbsp;
					<input style="width: 150px; height: 20px;" type="text" name="username" value="<?php echo htmlentities($username); ?>" />
				</p>
				<p>Password: &nbsp;
					<input style="width: 150px; height: 20px;" type="password" name="password" value="" />
				</p><br />
				<input style="width: 100px; height: 40px;" type="submit" name="submit" value="Login" />
			</form>
		</div>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>