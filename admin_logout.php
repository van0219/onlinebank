<?php
	session_start();
	include 'connection.php';
	$id = $_SESSION['adminLogin'];
	$query = "UPDATE ADMIN
			  SET LAST_ACCESS = CURRENT_TIMESTAMP
			  WHERE ID = '$id'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$_SESSION['adminLogin'] = 0;
	session_destroy();
	header('location:admin_login.php');
?>