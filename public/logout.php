<?php require_once("../includes/session.php"); ?>
<?php require_once("../includes/db_connection.php"); ?>

<?php

session_start();

session_unset();

session_destroy();

header("Location: index.php");

?>