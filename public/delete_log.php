<?php require_once( "../includes/session.php" ); ?>
<?php require_once( "../includes/db_connection.php" ); ?>
<?php require_once( "../includes/functions.php" ); ?>

<?php
if ( isset( $_SESSION["username"] ) ) {
	$current_username = $_SESSION["username"];
} else {
	$current_username = null;
}
$log = find_user_by_id( $current_username );
if ( ! $log ) {
	// trainer ID was missing or invalid or
	// trainer couldn't be found in database
	redirect_to( "logs.php" );
}

$date   = $log["DATE"];
$query  = "DELETE from logs WHERE DATE = '{$_GET['fetch_date']}' AND username='{$current_username}' LIMIT 1";
$result = mysqli_query( $connection, $query );

if ( $result && mysqli_affected_rows( $connection ) == 1 ) {
	//Success
	$_SESSION["message"] = "Log deleted.";
	redirect_to( "logs.php" );
} else {
	//Failure
	$_SESSION["message"] = mysqli_error($connection);
	redirect_to( "logs.php" );
}

?>
