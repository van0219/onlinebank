<?php
	session_start();
	if (!isset($_SESSION['adminLogin'])) {
		header('location:admin_login.php');
	}
?>
<?php
	include 'connection.php';
	$_SESSION['fname_'] = mysqli_real_escape_string($link, $_REQUEST['fname']);
	$_SESSION['mname_'] = mysqli_real_escape_string($link, $_REQUEST['mname']);
	$_SESSION['lname_'] = mysqli_real_escape_string($link, $_REQUEST['lname']);
	$_SESSION['gender_'] = mysqli_real_escape_string($link, $_REQUEST['gender']);
	$_SESSION['dob_']= mysqli_real_escape_string($link, $_REQUEST['dob']);
	$_SESSION['type_'] = mysqli_real_escape_string($link, $_REQUEST['type']);
	$_SESSION['credit_'] = mysqli_real_escape_string($link, $_REQUEST['initial']);
	$_SESSION['address_'] = mysqli_real_escape_string($link, $_REQUEST['address']);
	$_SESSION['mobile_'] = mysqli_real_escape_string($link, $_REQUEST['mobile']);
	$_SESSION['email_'] = mysqli_real_escape_string($link, $_REQUEST['email']);
	$_SESSION['password_'] = mysqli_real_escape_string($link, $_REQUEST['password']);
	$_SESSION['re_password_'] = mysqli_real_escape_string($link, $_REQUEST['re_password']);
	$_SESSION['branch_'] = mysqli_real_escape_string($link, $_REQUEST['branch']);
	#####
    $passLength = strlen($_SESSION['password_']);
        if ($passLength < 6 && $_SESSION['password_'] == $_SESSION['re_password_']) { //Password minimum is 6 chars.
            echo "<script>alert('Password minimum is 6 characters!');";
            echo "window.location = 'addAccount.php';</script>";
            exit();
        }
    $dob = $_SESSION['dob_'];
	$validateDOB = "SELECT DATEDIFF(NOW(),'$dob') / 366";//datediff returns number of days, so to get number of years, divide it by 366
	$resultDOB = mysqli_query($link, $validateDOB) or die(mysqli_error($link));
	$rowsDOB = mysqli_fetch_array($resultDOB);
	#####
	if ($rowsDOB[0] >= 18 && $rowsDOB[0] < 80) { //age must be 18-79 only
		$_SESSION['acc'] = 1;
		$query = "SELECT APP_ID 
				  FROM APP_CREDENTIALS
				  WHERE ID = 1";
		$res = mysqli_query($link, $query) or die(mysqli_error($link));
		$rows = mysqli_fetch_array($res);
		header("location:https://developer.globelabs.com.ph/dialog/oauth/".$rows[0]."");//goto globe registration
	}
	else{
		// echo "<script>alert('Age should not be less than 18 and not greater than 79 years old.');";
		echo "$dob";
		echo "window.location = 'addAccount.php';</script>";
	}
?>
