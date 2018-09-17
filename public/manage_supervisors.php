<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$supervisor_set = find_all_supervisors();
?>

<?php $layout_context = "supervisor"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
		&nbsp; 
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage Supervisors</h2>
		<table>
			<tr>
				<th style="text-align: left; width: 200px;">Username</th>
				<th colspan="2" style="text-align: left;">Actions</th>
			</tr>
		<?php while($supervisor = mysqli_fetch_assoc($supervisor_set)) { ?>
			<tr>
				<td><?php echo htmlentities($supervisor["username"]); ?></td>
				<td><a href="edit_supervisor.php?username=<?php echo urlencode($supervisor["username"]); ?>">Edit</a></td>
				<td><a href="delete_supervisor.php?username=<?php echo urlencode($supervisor["username"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
			</tr>
		<?php } ?>
		</table>
		<br />
		<a href="new_supervisor.php">Add new supervisor</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>