<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php
$message = '';
if (isset($_SESSION["username"])) {
    $current_username = $_SESSION["username"];
} else {
    $current_username = NULL;
}
retrieve_profile_data();
?>
<?php find_current_user($current_username); ?>

<?php
// CODE TO IDENTIFY USER
// echo htmlentities($_SESSION["username"]);
//if (!$profile_set) {
// user ID was missing or invalid or
// user couldn't be found in database
//redirect_to("profile.php");
//}
?>

<?php
if (isset($_POST['submit'])) {
    //Process the form

    $username = mysql_prep($_POST["username"]);
    $name = mysql_prep($_POST["name"]);
    $gender = (int) $_POST["gender"];
    $ID = (int) $_POST["ID"];
    $DOB = (int) $_POST["DOB"];
    $PA = mysql_prep($_POST["PA"]);
    $PC = (int) $_POST["PC"];
    $town = mysql_prep($_POST["town"]);
    $tel = mysql_prep($_POST["tel"]);
    $email = mysql_prep($_POST["email"]);
    $kin = mysql_prep($_POST["kin"]);
    $Relationship = mysql_prep($_POST["Relationship"]);
    $ktel = mysql_prep($_POST["ktel"]);
    $School = mysql_prep($_POST["School"]);
    $SPA = mysql_prep($_POST["SPA"]);
    $SPC = (int) $_POST["SPC"];
    $Stown = mysql_prep($_POST["Stown"]);
    $Stel = mysql_prep($_POST["Stel"]);
    $Semail = mysql_prep($_POST["Semail"]);
    $Dept = mysql_prep($_POST["Dept"]);
    $HOD = mysql_prep($_POST["HOD"]);
    $CC = mysql_prep($_POST["CC"]);
    $Company = mysql_prep($_POST["Company"]);
    $CPA = mysql_prep($_POST["CPA"]);
    $CPC = (int) $_POST["CPC"];
    $Ctown = mysql_prep($_POST["Ctown"]);
    $Ctel = mysql_prep($_POST["Ctel"]);
    $Cemail = mysql_prep($_POST["Cemail"]);
    $trainer = mysql_prep($_POST["trainer"]);
    $position = mysql_prep($_POST["position"]);

    // validations
    $required_fields = array("name", "ID", "tel", "email");
    validate_presences($required_fields);

    if (empty($errors)) {

        // Perform Update			
        $query = "UPDATE profile SET ";
        $query .= "username = '{$username}', ";
        $query .= "name = '{$name}', ";
        $query .= "gender = '{$gender}', ";
        $query .= "ID = {$ID}, ";
        $query .= "DOB = '{$DOB}', ";
        $query .= "PA = '{$PA}', ";
        $query .= "PC = '{$PC}', ";
        $query .= "town = '{$town}', ";
        $query .= "tel = '{$tel}', ";
        $query .= "email = '{$email}', ";
        $query .= "kin = '{$kin}', ";
        $query .= "Relationship = '{$Relationship}', ";
        $query .= "ktel = '{$ktel}', ";
        $query .= "School = '{$School}', ";
        $query .= "SPA = '{$SPA}', ";
        $query .= "SPC = '{$SPC}', ";
        $query .= "Stown = '{$Stown}', ";
        $query .= "Stel = '{$Stel}', ";
        $query .= "Semail = '{$Semail}', ";
        $query .= "Dept = '{$Dept}', ";
        $query .= "HOD = '{$HOD}', ";
        $query .= "CC = '{$CC}', ";
        $query .= "Company = '{$Company}', ";
        $query .= "CPA = '{$CPA}', ";
        $query .= "CPC = '{$CPC}', ";
        $query .= "Ctown = '{$Ctown}', ";
        $query .= "Ctel = '{$Ctel}', ";
        $query .= "Cemail = '{$Cemail}', ";
        $query .= "trainer = '{$trainer}', ";
        $query .= "position = '{$position}' ";
        $query .= "WHERE username = '{$current_username}'; ";
        //$query .= "LIMIT 1";
        print_r($query);
        $result = mysqli_query($connection, $query);

        //$data = mysqli_fetch_assoc($result);

        if ($result && mysqli_affected_rows($connection) >= 0) {
            //Success
            $message = "Profile updated.";
            redirect_to("profile.php?page={$ID}");
        } else {
            //Failure
            $message = "Profile update failed." . mysqli_affected_rows($connection);
        }
    }
} else {
    // This is probably a get request
} // end: if (isset($_POST['submit']))
?>

<?php $layout_context = "student"; ?>
<?php include("../includes/layouts/header.php"); ?>

<div id="main">
    <div id="navigation">
        <br />
        <a href="student.php">&laquo; Main menu</a><br />
    </div>
    <div id="page">
        <?php echo $message; ?>
        <?php echo form_errors($errors); ?>
        <?php
        $query = "SELECT * FROM users WHERE username = '" . $current_username . "';";
        $result = mysqli_query($connection, $query);
        $resultcheck = mysqli_num_rows($result);
        $profilecheck = retrieve_profile_data();

        if ($resultcheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
                while ($rowp = mysqli_fetch_assoc($profilecheck)) {
                    ?>

                    <h2>Edit <?php echo htmlentities($_SESSION["username"]); ?>'s Profile</h2>
					
					//imported code
					<div class="message"><?php if(isset($message)) echo $message; ?></div>
						<ul id="registration-step">
						<li id="account" class="highlight">Account</li>
						<li id="password">Credentials</li>
						<li id="general">General</li>
						</ul>
					<form name="frmRegistration" id="registration-form" method="post">
						<div id="account-field">
						<label>Email</label><span id="email-error" class="registration-error"></span>
						<div><input type="text" name="email" id="email" class="demoInputBox" /></div>
						</div>
						<div id="password-field" style="display:none;">
						<label>Enter Password</label><span id="password-error" class="registration-error"></span>
						<div><input type="password" name="password" id="user-password" class="demoInputBox" /></div>
						<label>Re-enter Password</label><span id="confirm-password-error" class="registration-error"></span>
						<div><input type="password" name="confirm-password" id="confirm-password" class="demoInputBox" /></div>
						</div>
						<div id="general-field" style="display:none;">
						<label>Display Name</label>
						<div><input type="text" name="display-name" id="display-name" class="demoInputBox"/></div>
						<label>Gender</label>
						<div>
						<select name="gender" id="gender" class="demoInputBox">
						<option value="female">Female</option>
						<option value="male">Male</option>
						</select></div>
						</div>
						<div>
						<input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
						<input class="btnAction" type="button" name="next" id="next" value="Next" >
						<input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
						</div>
					</form>
					
					//end of imported code
					
					
					
                    <ul id="registration-step">
						<li id="personal" class="highlight">A. PERSONAL DETAILS (ATTACHEE)</li>
						<li id="school">B. TRAINING INSTITUTION</li>
						<li id="attachment">C.	DETAILS OF ATTACHMENT PLACE</li>
						<li id="trainer">D.	INDUSTRIAL ATTACHMENT TRAINER</li>
					</ul>
						
					<form action="edit_profile.php" method="POST">
						
					
					
					
					
					
                        <h3> A.	PERSONAL DETAILS (ATTACHEE)</h3>
                        <p>
                            Username: <input type="text" name="username" value="<?php echo $rowp['username']; ?>" />
                            Name: <input type="text" name="name" value="<?php echo $rowp['name']; ?>" />
                            <?php
                            if ($rowp['gender'] == 1) {
                                $man = 'checked';
                                $wom = '';
                            } else {
                                $man = '';
                                $wom = 'checked';
                            }
                            ?>
                            Gender: 
                            Male <input type="radio" name="gender" value="1" <?= $man ?> />
                            Female <input type="radio" name="gender" value="0" <?= $wom ?>/>
                        </p>
                        <p>
                            ID/Passport No: <input type="text" name="ID" value="<?php echo $rowp['ID']; ?>" />
                            Date of Birth: <input type="date" name="DOB" value="<?php echo $rowp['DOB']; ?>" placeholder="YYYY-MM-DD" />
                        </p>
                        <p>
                            Home Postal Address <input type="text" name="PA" value="<?php echo $rowp['PA']; ?>" />
                            Postal code <input type="text" name="PC" value="<?php echo $rowp['PC']; ?>" />
                            Town <input type="text" name="town" value="<?php echo $rowp['town']; ?>" />
                        </p>
                        <p>
                            Telephone: <input type="text" name="tel" value="<?php echo $rowp['tel']; ?>" />
                            Email: <input type="text" name="email" value="<?php echo $rowp['email']; ?>" />
                        </p>
                        <p> 
                            Next of Kin(Name): <input type="text" name="kin" value="<?php echo $rowp['kin']; ?>" />
                            Relationship <input type="text" name="Relationship" value="<?php echo $rowp['Relationship']; ?>" />
                            Telephone <input type="text" name="ktel" value="<?php echo $rowp['ktel']; ?>" />
                        </p>

                        <h3> B.	TRAINING INSTITUTION </h3>
                        <p>	
                            Name: <input type="text" name="School" value="<?php echo $rowp['School']; ?>" />
                            Postal Address: <input type="text" name="SPA" value="<?php echo $rowp['SPA']; ?>" />
                            Postal code: <input type="text" name="SPC" value="<?php echo $rowp['SPC']; ?>" />
                            Town: <input type="text" name="Stown" value="<?php echo $rowp['Stown']; ?>" />
                        </p>
                        <p>
                            Telephone <input type="text" name="Stel" value="<?php echo $rowp['Stel']; ?>" />
                            Email <input type="text" name="Semail" value="<?php echo $rowp['Semail']; ?>" />
                        </p>
                        <p>Department: <input type="text" name="Dept" value="<?php echo $rowp['Dept']; ?>" />
                            Head of Department: <input type="text" name="HOD" value="<?php echo $rowp['HOD']; ?>" />
                            Course code: <input type="text" name="CC" value="<?php echo $rowp['CC']; ?>" />
                        </p>

                        <h3> C.	DETAILS OF ATTACHMENT PLACE </h3>
                        <p>
                            Name of Organization: <input type="text" name="Company" value="<?php echo $rowp['Company']; ?>" />
                            Postal Address: <input type="text" name="CPA" value="<?php echo $rowp['CPA']; ?>" />
                            Postal code: <input type="text" name="CPC" value="<?php echo $rowp['CPC']; ?>" />
                            Town: <input type="text" name="Ctown" value="<?php echo $rowp['Ctown']; ?>" />
                        </p>
                        <p>
                            Telephone <input type="text" name="Ctel" value="<?php echo $rowp['Ctel']; ?>" />
                            Email <input type="text" name="Cemail" value="<?php echo $rowp['Cemail']; ?>" />
                        </p>

                        <h3> D.	INDUSTRIAL ATTACHMENT TRAINER </h3>
                        <p>
                            Name: <input type="text" name="trainer" value="<?php echo $rowp['trainer']; ?>" />
                            Position/Designation: <input type="text" name="position" value="<?php echo $rowp['position']; ?>" />
                        </p>

                        <input type="submit" name="submit" value="Edit Profile" />
                        &nbsp;
                        &nbsp;
                    <?php
                    }
                }
                ?>
			<?php } ?>
            <a href="profile.php">Cancel</a>
        </form>		
    </div>
</div>

<?php include("../includes/layouts/footer.php"); ?>