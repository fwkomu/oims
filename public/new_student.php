<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
if (isset($_POST['submit'])) {
    //Process the form
    // validations
    $required_fields = array("username", "password");
    validate_presences($required_fields);

    $fields_with_max_lengths = array("username" => 30);
    validate_max_lengths($fields_with_max_lengths);

    if (empty($errors)) {
        // Perform Create

        $username = mysql_prep($_POST["username"]);
        $hashed_password = password_encrypt($_POST["password"]);
        $studemail = mysql_prep($_POST["studemail"]);

        $query = "INSERT INTO users (";
        $query .= " username, email, hashed_password, user_role";
        $query .= ") VALUES (";
		$query .= " '{$username}', '{$studemail}', '{$hashed_password}', 'student'";
        $query .= ")";
        $result = mysqli_query($connection, $query);

        if ($result) {
            //Success
            $_SESSION["message"] = "Student created. We sent an email with the login details. Check junk/spam too!";
            if (welcome_email($_POST['studemail'], "Account Log in Details", $_POST["username"], $_POST["password"])) {
                redirect_to("manage_students.php");
            } else {
                //Email failure
                $_SESSION["message"] = "Student creation successful but account details email failed.";
            }
        } else {
            //Failure
            $_SESSION["message"] = "Student creation failed.";
        }
    }
} else {
    // This is probably a GET request
} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = "student"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
    <div id="navigation">
        <br />
        <a href="admin.php">&laquo; Main menu</a><br />
        &nbsp;
    </div>
    <div id="page">
<?php echo message(); ?>
        <?php echo form_errors($errors); ?>

        <h2>Create Student</h2>
        <form action="new_student.php" method = "POST">
            <p>Username:
                <input type="text" name="username" value="" />
            </p>
            <p>Email:
                <input type="email" name="studemail" value="" />
            </p>
            <p>Password:
                <input type="password" name="password" value="" />
            </p>
            <input type="submit" name="submit" value="Create Student" />
        </form>
        <br />
        <a href="manage_students.php">Cancel</a>
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>