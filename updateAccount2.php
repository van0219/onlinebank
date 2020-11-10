<?php
	session_start();
	if (!isset($_SESSION['adminLogin'])) {
		header('location:admin_login.php');
	}
?>
<!--#####-->
<?php
	include 'connection.php';
	$id = $_SESSION['_currID'];
	$fname = $_SESSION['_fname'];
	$mname = $_SESSION['_mname'];
	$lname = $_SESSION['_lname'];
	$gender = $_SESSION['_gender'];
	$dob = $_SESSION['_dob'];
	$type = $_SESSION['_type'];
	$address = $_SESSION['_address'];
	$mobile = $_SESSION['_mobile'];
	$email = $_SESSION['_email'];
	#####
	$query = "UPDATE ACCOUNTS
			  SET FNAME = UPPER('$fname')
			  	 ,MNAME = UPPER('$mname')
			  	 ,LNAME = UPPER('$lname')
			     ,GENDER = '$gender'		     
			     ,DOB = '$dob'
			     ,ACC_TYPE = '$type'
			     ,ADDRESS = UPPER('$address')
			     ,MOBILE = '$mobile'
			     ,EMAIL = '$email'
			  WHERE ID = '$id'";
	mysqli_query($link, $query) or die(mysqli_error($link));
	echo "<script>alert('Updated Successfully!');";
	echo "window.location = 'showAccount.php';</script>";
?>