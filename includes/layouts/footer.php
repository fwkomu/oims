<div id="footer">Copyright <?php echo date("Y")?>, Phoenix</div>
<script type="text/javascript" src="javascripts/jquery.js"></script>
<script type="text/javascript" src="javascripts/wizard.js"></script>			
	</body>
</html>
<?php
	//5. Close database connection
	if (isset($connection)) {
		mysqli_close($connection);
	}
?>