<?php
	session_start();
	include 'connection.php';
	$id = $_SESSION['id'];
	$query = "UPDATE PERSONNEL
			  SET LAST_ACCESS = CURRENT_TIMESTAMP
			  WHERE ID = '$id'";
	mysqli_query($link, $query) or die(mysqli_error($link));
	$_SESSION['empLogin'] = 0;
	#####
	session_destroy();
	header('location:empLogin.php');
?>