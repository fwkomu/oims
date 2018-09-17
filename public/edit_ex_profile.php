<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php find_selected_page(); ?>

<?php 
	// Can't add a new page unless we have a subject as a parent!
	if (!$current_subject) {
		// subject ID was missing or invalid or
		// subject couldn't be found in database
		//redirect_to("manage_content.php");
	}
?>

<?php
	if (isset($_POST['submit'])) {
		//Process the form
		
		// validations
		$required_fields = array("name", "ID", "tel", "email");
		validate_presences($required_fields);
		
		$fields_with_max_lengths = array("name" => 30);
		validate_max_lengths($fields_with_max_lengths);
		
		if (empty($errors)) {
			// Perform Create
			
			// make sure you add the subject_id!
			$username = $current_user["username"];
			$name = mysql_prep($_POST["name"]);
			$gender = mysql_prep($_POST["gender"]);
			$ID = (int) $_POST["ID"];
			$DOB = mysql_prep($_POST["DOB"]);
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
		
			$query = "INSERT INTO profile (";
			$query .= " name, gender, ID, DOB, PA, PC, town, tel, email, kin, Relationship, ktel, School, SPA, SPC, Stown, Stel, Semail, Dept, HOD, CC, Company, CPA, CPC, Ctown, Ctel, Cemail, trainer, position";
			$query .= ") VALUES (";
			$query .= " '{$name}', '{$gender}', {$ID}, {$DOB}, '{$PA}', {$PC}, '{$town}', '{$tel}', '{$email}', '{$kin}', '{$Relationship}', '{$ktel}', '{$School}', '{$SPA}', {$SPC}, '{$Stown}', '{$Stel}', '{$Semail}', '{$Dept}', '{$HOD}', '{$CC}', '{$Company}', '{$CPA}', {$CPC}, '{$Ctown}', '{$Ctel}', '{$Cemail}', '{$trainer}', '{$position}'";
			$query .= ")";
			$result = mysqli_query($connection, $query);
			
			if($result){
				//Success
				$_SESSION["message"] = "Profile created.";
				redirect_to("profile.php");
			} else {
				//Failure
				$_SESSION["message"] = "Profile creation failed";
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
		<a href="student.php">&laquo; Main menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>Create Profile</h2>
		
		<div id="registration-step" class="tab">
		   <button id="personal" class="tablinks" onclick="openTab(event, 'Personal')" id="defaultOpen">Personal Details</button>
		   <button id="training" class="tablinks" onclick="openTab(event, 'Training')">Training Institution</button>
		   <button id="attachment" class="tablinks" onclick="openTab(event, 'Attachment')">Attachment Details</button>
		</div>
		
		<!--<div class="message"><?php if(isset($message)) echo $message; ?></div>-->
		<br />
		<form name="frmRegistration" id="registration-form" method="post">
			<div id="personal-field">
				<label>Name</label><span id="name-error" class="registration-error"></span>
				<div><input type="text" name="name" id="name" value="" /></div><br />
				<label>Gender</label>
				<div>
				Male <input type="radio" name="gender" value="" checked />
				Female <input type="radio" name="gender" value="" />
				</div> <br />
				<label>ID/Passport No</label><span id="id-error" class="registration-error"></span>
				<div><input type="text" name="ID" id="id" value="" /></div><br />
				<label>Date of Birth</label><span id="dob-error" class="registration-error"></span>
				<div><input type="date" name="DOB" id="DOB" value="" placeholder="YYYY-MM-DD" /></div><br />
				<label>Home Postal Address</label><span id="PA-error" class="registration-error"></span>
				<div><input type="text" name="PA" id="PA" value="" /></div><br />
				<label>Postal code</label><span id="PC-error" class="registration-error"></span>
				<div><input type="text" name="PC" id="PC" value="" /></div><br />
			<!--	<label>Town</label><span id="town-error" class="registration-error"></span>
				<div><input type="text" name="town" id="town" value="" /></div><br />
				<label>Telephone</label><span id="tel-error" class="registration-error"></span>
				<div><input type="text" name="tel" id="tel" value="" /></div><br />
				<label>Email</label><span id="email-error" class="registration-error"></span>
				<div><input type="text" name="email" id="email" value="" /></div><br />
				<label>Next of Kin(Name)</label><span id="kin-error" class="registration-error"></span>
				<div><input type="text" name="kin" id="kin" value="" /></div><br />
				<label>Relationship</label><span id="Relationship-error" class="registration-error"></span>
				<div><input type="text" name="Relationship" id="Relationship" value="" /></div><br />
				<label>Telephone</label><span id="ktel-error" class="registration-error"></span>
				<div><input type="text" name="ktel" id="ktel" value="" /></div><br />-->
			</div>
			
			<div id="training-field" style="display:none;">	
				<label>Name</label><span id="School-error" class="registration-error"></span>
				<div><input type="text" name="School" id="School" value="" /></div><br />
				<label>Postal Address</label><span id="SPA-error" class="registration-error"></span>
				<div><input type="text" name="SPA" id="SPA" value="" /></div><br />
				<label>Postal code</label><span id="SPC-error" class="registration-error"></span>
				<div><input type="text" name="SPC" id="SPC" value="" /></div><br />
				<label>Town</label><span id="Stown-error" class="registration-error"></span>
				<div><input type="text" name="Stown" id="Stown" value="" /></div><br />
				<label>Telephone</label><span id="Stel-error" class="registration-error"></span>
				<div><input type="text" name="Stel" id="Stel" value="" /></div><br />
				<label>Email</label><span id="Semail-error" class="registration-error"></span>
				<div><input type="text" name="Semail" id="Semail" value="" /></div><br />
				<label>Department</label><span id="Dept-error" class="registration-error"></span>
				<div><input type="text" name="Dept" id="Dept" value="" /></div><br />
				<label>Head of Department</label><span id="HOD-error" class="registration-error"></span>
				<div><input type="text" name="HOD" id="HOD" value="" /></div><br />
				<label>Course code</label><span id="CC-error" class="registration-error"></span>
				<div><input type="text" name="CC" id="CC" value="" /></div><br />
			</div>

			<div id="attachment-field" style="display:none;">	
				<label>Name of Organization</label><span id="Company-error" class="registration-error"></span>
				<div><input type="text" name="Company" id="Company" value="" /></div><br />
				<label>Postal Address</label><span id="CPA-error" class="registration-error"></span>
				<div><input type="text" name="CPA" id="CPA" value="" /></div><br />
				<label>Postal code</label><span id="CPC-error" class="registration-error"></span>
				<div><input type="text" name="CPC" id="CPC" value="" /></div><br />
				<label>Town</label><span id="Ctown-error" class="registration-error"></span>
				<div><input type="text" name="Ctown" id="Ctown" value="" /></div><br />
				<label>Telephone</label><span id="Ctel-error" class="registration-error"></span>
				<div><input type="text" name="Ctel" id="Ctel" value="" /></div><br />
				<label>Email</label><span id="Cemail-error" class="registration-error"></span>
				<div><input type="text" name="Cemail" id="Cemail" value="" /></div><br />
				<label>Trainer Name</label><span id="trainer-error" class="registration-error"></span>
				<div><input type="text" name="trainer" id="trainer" value="" /></div><br />
				<label>Position/Designation</label><span id="position-error" class="registration-error"></span>
				<div><input type="text" name="position" id="position" value="" /></div><br />
			</div>
			
			<div>
			<input class="btnAction" type="button" name="back" id="back" value="Back" style="display:none;">
			<input class="btnAction" type="button" name="next" id="next" value="Next" >
			<input class="btnAction" type="submit" name="finish" id="finish" value="Finish" style="display:none;">
			</div>

			<br />
			<input type="submit" name="submit" value="Create Profile" />
			<a href="profile.php">Cancel</a>
		</form>
		<br />
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>