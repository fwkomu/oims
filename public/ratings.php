<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php require_once("../includes/validation_functions.php"); ?>

<?php $layout_context = "admin"; ?>
<?php include("../includes/layouts/header.php"); ?>
<div id="main">
	<div id="navigation">
		&nbsp;
	</div>
	<div id="page">
		<?php echo message(); ?>
		<?php echo form_errors($errors); ?>
		
		<h2>RATINGS/ASSESSMENT</h2>
		<form action="" id="rate" method = "POST">
			<table id="rate" width="90%" cellpadding="5">
				<thead>
					<tr>
						<th rowspan="2" colspan="2"><h3>ASSESSMENT AREAS</h3></th>
						<th colspan="5"><h3>RATING SCALE</h3></th>
					</tr>
					<tr>
						<th>Poor</th>
						<th>Below-Average</th>
						<th>Average</th>
						<th>Good</th>
						<th>Excellent</th>
					</tr>
				</thead>
				<tbody>
					<?php /*
						if ($rowp['value'] == 1) {
							$poor = 'checked';
						} else if ($rowp['value'] == 2) {
							$belowavg = 'checked';
						} else if ($rowp['value'] == 3) {
							$avg = 'checked';
						} else if ($rowp['value'] == 4) {
							$good = 'checked';
						} else if ($rowp['value'] == 5) {
							$excellent = 'checked';
						} */
						?>
					<tr>
						<td>1.</td><td>Availability of required documentation (5)</td>
						<td align="center"><input type="radio" name="documentation" value="doc1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="documentation" value="doc2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="documentation" value="doc3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="documentation" value="doc4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="documentation" value="doc5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>2.</td><td>Degree of organization of daily entries in internship system (10)</td>
						<td align="center"><input type="radio" name="organization" value="org1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="organization" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="organization" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="organization" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="organization" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>3.</td><td>Level of adaptability of attachee in the organization/institution (10)</td>
						<td align="center"><input type="radio" name="adaptability" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="adaptability" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="adaptability" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="adaptability" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="adaptability" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>4.</td><td>Ability to work in teams (10)</td>
						<td align="center"><input type="radio" name="teamwork" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="teamwork" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="teamwork" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="teamwork" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="teamwork" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>5.</td><td>Accomplishment of assignments  (10)</td>
						<td align="center"><input type="radio" name="assignments" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="assignments" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="assignments" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="assignments" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="assignments" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>6.</td><td>Presence at designated areas (10)</td>
						<td align="center"><input type="radio" name="presence" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="presence" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="presence" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="presence" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="presence" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>7.</td><td>Communication skills (10)</td>
						<td align="center"><input type="radio" name="communication" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="communication" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="communication" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="communication" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="communication" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>8.</td><td>Mannerism (10)</td>
						<td align="center"><input type="radio" name="mannerism" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="mannerism" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="mannerism" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="mannerism" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="mannerism" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>9.</td><td>Student understanding of assignments/tasks given (15)</td>
						<td align="center"><input type="radio" name="understanding" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="understanding" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="understanding" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="understanding" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="understanding" value="5" onclick="calculateTotal()" > </td>
					</tr>
					<tr>
						<td>10.</td><td>Oral presentation (10)</td>
						<td align="center"><input type="radio" name="oral" value="1" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="oral" value="2" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="oral" value="3" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="oral" value="4" onclick="calculateTotal()" > </td>
						<td align="center"><input type="radio" name="oral" value="5" onclick="calculateTotal()" > </td>
					</tr>
					
					
					<tr>
						<div id="totalPrice"></div>
						<!--<td></td><td align="center">TOTAL</td><td colspan="5"><input type="text" name="total" value="" /></td>-->
					</tr>
				<tbody>
			</table>
		</form>
	</div>
</div>

<?php include("javascripts/calculate.js"); ?>
<?php include("../includes/layouts/footer.php"); ?>