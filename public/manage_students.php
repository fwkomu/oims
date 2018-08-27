<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$student_set = find_all_students();
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
		<h2>Manage Students</h2>
		<table>
			<tr>
				<th style="text-align: left; width: 200px;">Username</th>
				<th colspan="2" style="text-align: left;">Actions</th>
			</tr>
		<?php while($student = mysqli_fetch_assoc($student_set)) { ?>
			<tr>
				<td><?php echo htmlentities($student["username"]); ?></td>
				<td><a href="edit_student.php?id=<?php echo urlencode($student["username"]); ?>">Edit</a></td>
				<td><a href="delete_student.php?id=<?php echo urlencode($student["username"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
			</tr>
		<?php } ?>
		</table>
		<br />
		<a href="new_student.php">Add new student</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>