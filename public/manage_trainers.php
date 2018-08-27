<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>

<?php
	$trainer_set = find_all_trainers();
?>

<?php $layout_context = "trainer"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		<br />
		<a href="admin.php">&laquo; Main menu</a><br />
		&nbsp; 
	</div>
	<div id="page">
		<?php echo message(); ?>
		<h2>Manage Trainers</h2>
		<table>
			<tr>
				<th style="text-align: left; width: 200px;">Username</th>
				<th colspan="2" style="text-align: left;">Actions</th>
			</tr>
		<?php while($trainer = mysqli_fetch_assoc($trainer_set)) { ?>
			<tr>
				<td><?php echo htmlentities($trainer["username"]); ?></td>
				<td><a href="edit_trainer.php?id=<?php echo urlencode($trainer["username"]); ?>">Edit</a></td>
				<td><a href="delete_trainer.php?id=<?php echo urlencode($trainer["username"]); ?>" onclick="return confirm('Are you sure?');">Delete</a></td>
			</tr>
		<?php } ?>
		</table>
		<br />
		<a href="new_trainer.php">Add new trainer</a>
	</div>
</div>

<?php include("../includes/layouts/footer.php"); ?>