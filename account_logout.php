<?php 
	session_start();
	include 'connection.php';
	#####
	$id = $_SESSION['login_id'];
	$query = "UPDATE ACCOUNTS
		      SET LAST_ACCESS = CURRENT_TIMESTAMP
		      WHERE ID = '$id'";
	mysqli_query($link, $query) or die(mysqli_error($link));
	#####
	$_SESSION['accountLogin'] = 0;
	session_destroy();
	header('location:main.php');
?>