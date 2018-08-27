<?php 
	if(!isset($layout_context)) { 
		$layout_context = "public";
	}
?>

<?php logged_in(); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
	
<html lang="en">
	<head>
		<title>OIMS <?php if ($layout_context == "admin") { echo "Admin"; } ?></title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css" />
		<link href="air-datepicker/css/datepicker.min.css" rel="stylesheet" type="text/css" />
		<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		<link href="stylesheets/wizard.css" media="all" rel="stylesheet" type="text/css" />
	</head>
	<body>
	<div>
		<div id="cuea_logo">
			<img src="images/cuea_logo.png" width="110" height="110" alt="cuea_logo" align="left" /> <br />
			<?php if (!isset($_SESSION['username'])){ ?>
			<a class="login_out" href="login.php"><i class="fa fa-sign-in fa-fw" aria-hidden="true"></i>Login</a>
			<?php } else { ?>
			<a class="login_out" href="logout.php"><i class="fa fa-sign-out fa-fw" aria-hidden="true"></i>Logout</a>
			<?php } ?>
		</div>
		<div style="color:#8D0D19" id="cuea_name">
			<h2 align="left">The Catholic University of Eastern Africa</h2>
			<p>Consecrate them in the truth</p>
		</div>
	</div>
		<div id="header">
			<h1>
				OIMS <?php if ($layout_context == "admin") { echo "Admin Portal"; } ?> 
				<a class="header_link" href="index.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i>Home</a>
				
			</h1>
		</div>