<?php
	session_start();

	if(!isset($_SESSION['adminLogin'])){
		header('location:admin_login.php');
	}
?>
<!--#####-->
<?php
	include 'connection.php';
	$_SESSION['fname_'] = mysqli_real_escape_string($link, $_REQUEST['fname']);
	$_SESSION['mname_'] = mysqli_real_escape_string($link, $_REQUEST['mname']);
	$_SESSION['lname_'] = mysqli_real_escape_string($link, $_REQUEST['lname']);
	$_SESSION['gender_'] = mysqli_real_escape_string($link, $_REQUEST['gender']);
	$_SESSION['dob_'] = mysqli_real_escape_string($link, $_REQUEST['dob']);
	$_SESSION['status_'] = mysqli_real_escape_string($link, $_REQUEST['status']);
	$_SESSION['branch_'] = mysqli_real_escape_string($link, $_REQUEST['branch']);
	$_SESSION['dateHired_'] = mysqli_real_escape_string($link, $_REQUEST['dateHired']);
	$_SESSION['address_'] = mysqli_real_escape_string($link, $_REQUEST['address']);
	$_SESSION['mobile_'] = mysqli_real_escape_string($link, $_REQUEST['mobile']);
	$_SESSION['email_'] = mysqli_real_escape_string($link, $_REQUEST['email']);
	$_SESSION['password_'] = mysqli_real_escape_string($link, $_REQUEST['password']);
	$_SESSION['re_password_'] = mysqli_real_escape_string($link, $_REQUEST['re_password']);
	$_SESSION['passLength_'] = strlen(mysqli_real_escape_string($link, $_REQUEST['password']));
	$passLength = $_SESSION['passLength_'];
	$dob = $_SESSION['dob_'];
	if ($passLength >= 6 && $_SESSION['password_'] == $_SESSION['re_password_']) { //minimum length for password is 6 chars.
		$salt = "5%GHD7**0HGDs325kX";
		$_SESSION['password_'] = MD5(sha1(mysqli_real_escape_string($link, $_REQUEST['password']).$salt));
		#####
		$validateDOB = "SELECT DATEDIFF(NOW(),'$dob') / 366";
		$resultDOB = mysqli_query($link, $validateDOB) or die(mysqli_error($link));
		$rowsDOB = mysqli_fetch_array($resultDOB);
		#####
		$query = "SELECT APP_ID 
				  FROM APP_CREDENTIALS
				  WHERE ID = 1";
		$res = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_fetch_array($res);
		if ($rowsDOB[0] >= 18 && $rowsDOB[0] < 60) { //check age requirement. 18-59 only.
			$_SESSION['emp'] = 1;
			header("location:https://developer.globelabs.com.ph/dialog/oauth/".$rows[0]);
		}
		else{
			echo "<script>alert('Age should not be less than 18 and not greater than 59 years old.');";
			echo "window.location = 'addEmployee.php';</script>";
		}	
	}	
	else{
		if ($_SESSION['password_'] != $_SESSION['re_password_']) {
			echo "Passwords do not match!";
		}
		else{
			echo "<script>alert('Password minimum is 6 characters!');</script>";
		}
		//echo "<script>window.location = 'addEmployee.php';</script>";
	}						
?>
