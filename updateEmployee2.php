<?php
	session_start();
	if (!isset($_SESSION['adminLogin'])) {
		header('location:admin_login.php');
	}
?>
<?php
	include 'connection.php';
	$id = $_SESSION['_currID'];
	$fname = $_SESSION['_fname'];
	$mname = $_SESSION['_mname'];
	$lname = $_SESSION['_lname'];
	$gender = $_SESSION['_gender'];
	$dob = $_SESSION['_dob'];
	$civil = $_SESSION['_status'];
	$branch = $_SESSION['_branch'];
	$hireDate = $_SESSION['_dateHired'];
	$address = $_SESSION['_address'];
	$mobile = $_SESSION['_mobile'];
	$email = $_SESSION['_email'];
	#####
	$query = "UPDATE PERSONNEL
			  SET FNAME = '$fname'
			  	 ,MNAME = '$mname'
			  	 ,LNAME = '$lname'
			  	 ,GENDER = '$gender'
			  	 ,DOB = '$dob'
			  	 ,CIVIL_STATUS = '$civil'
			  	 ,BRANCH = '$branch'
			  	 ,DATE_HIRED = '$hireDate'
			  	 ,ADDRESS = '$address'
			  	 ,MOBILE = '$mobile'
			  	 ,EMAIL = '$email'
			  WHERE ID = '$id'";
	mysqli_query($link, $query) or die(mysqli_error($link));
	echo "<script>alert('Updated Successfully!');";
	echo "window.location = 'showEmployee.php';</script>";
?>