/*functionality that allows admin to schedule supervisors that will
visit students at place of attachment. Checks the supervisors in database and assigns*/

<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		
		
		
	</div>
</div>





















<?php include("../includes/layouts/footer.php"); ?>