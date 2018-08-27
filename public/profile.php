<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php $layout_context = "student"; ?>
<?php include("../includes/layouts/header.php"); ?>

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

<div id="main">
	<div id="navigation">
		<br />
		<a href="student.php">&laquo; Main menu</a><br /><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php
			$query = "SELECT * FROM users WHERE username = '" . $current_username . "';";
			$result = mysqli_query($connection, $query);
			$resultcheck = mysqli_num_rows($result);
			$profilecheck = retrieve_profile_data();
			
			if ($resultcheck > 0) {
				while ($row = mysqli_fetch_assoc($result)) {
					while ($rowp = mysqli_fetch_assoc($profilecheck)) {
		?>
			<div class="tab">
			   <button class="tablinks" onclick="openTab(event, 'Personal')" id="defaultOpen">Personal Details</button>
			   <button class="tablinks" onclick="openTab(event, 'Training')">Training Institution</button>
			   <button class="tablinks" onclick="openTab(event, 'Attachment')">Attachment Details</button>
			</div>

			<div id="Personal" class="tabcontent">
			  <h3> A.	PERSONAL DETAILS (ATTACHEE)</h3>
				<b>Name:</b> <?php echo $rowp['name']; ?><br /><br />
				<b>Gender:</b> 
				<?php
					if ($rowp['gender'] == 1) {
						echo 'Male';
					} else {
						echo 'Female';
					}
				?>
				<br /><br />
				<b>ID/Passport No:</b> <?php echo $rowp['ID']; ?><br /><br />
				<b>Date of Birth:</b> <?php echo $rowp['DOB']; ?><br /><br />
				<b>Home Postal Address:</b> <?php echo $rowp['PA']; ?><br /><br />
				<b>Postal code:</b>  <?php echo $rowp['PC']; ?> &nbsp; Town: <?php echo $rowp['town']; ?><br /><br />
				<b>Telephone:</b> <?php echo $rowp['tel']; ?><br /><br />
				<b>Email:</b> <?php echo $rowp['email']; ?><br /><br />
				<b>Next of Kin (Name):</b> <?php echo $rowp['kin']; ?><br /><br />
				<b>Relationship:</b> <?php echo $rowp['Relationship']; ?><br /><br />
				<b>Telephone:</b> <?php echo $rowp['ktel']; ?><br /><br />
			</div>
		
			<div id="Training" class="tabcontent">
				<h3> B.	TRAINING INSTITUTION </h3>
				<b>Name:</b> <?php echo $rowp['School']; ?><br /><br />
				<b>Postal Address:</b> <?php echo $rowp['SPA']; ?><br /><br />
				<b>Postal code:</b> <?php echo $rowp['SPC']; ?><br /><br />
				<b>Town:</b> <?php echo $rowp['Stown']; ?><br /><br />
				<b>Telephone:</b> <?php echo $rowp['Stel']; ?><br /><br />
				<b>Email:</b> <?php echo $rowp['Semail']; ?><br /><br />
				<b>Department:</b> <?php echo $rowp['Dept']; ?><br /><br />
				<b>Head of Department:</b> <?php echo $rowp['HOD']; ?><br /><br />
				<b>Course code:</b> <?php echo $rowp['CC']; ?><br /><br />
			</div>
			<br />
			<div id="Attachment" class="tabcontent">
				<h3> C.	DETAILS OF ATTACHMENT PLACE </h3>
				<b>Name of Organization:</b> <?php echo $rowp['Company']; ?><br /><br />
				<b>Postal Address:</b> <?php echo $rowp['CPA']; ?><br /><br />
				<b>Postal code:</b> <?php echo $rowp['CPC']; ?><br /><br />
				<b>Town:</b> <?php echo $rowp['Ctown']; ?><br /><br />
				<b>Telephone:</b> <?php echo $rowp['Ctel']; ?><br /><br />
				<b>Email:</b> <?php echo $rowp['Cemail']; ?><br /><br />

				<h3> D.	INDUSTRIAL ATTACHMENT TRAINER </h3>
				<b>Name:</b> <?php echo $rowp['trainer']; ?><br /><br />
				<b>Position/Designation:</b> <?php echo $rowp['position']; ?><br /><br />
			</div> 
			<br />
			<a href="edit_profile.php">Edit Profile</a>
			
				<?php 
					}
				} 
				?>
			<?php } ?>
	</div>
</div>

<!-- Include javascript code -->
<!-- Include javascript code -->
<script type="text/javascript" src="javascripts/public.js"></script>

<?php include("../includes/layouts/footer.php"); ?>