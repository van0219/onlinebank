<?php
	session_start();
	if (!isset($_SESSION['adminLogin'])) {
		header('location:admin_login.php');
	}
?>
<?php
	include 'connection.php';
	$_SESSION['_currID'] = mysqli_real_escape_string($link, $_REQUEST['currID']);
	$_SESSION['_fname'] = mysqli_real_escape_string($link, $_REQUEST['fname']);
	$_SESSION['_mname'] = mysqli_real_escape_string($link, $_REQUEST['mname']);
	$_SESSION['_lname'] = mysqli_real_escape_string($link, $_REQUEST['lname']);
	$_SESSION['_gender'] = mysqli_real_escape_string($link, $_REQUEST['gender']);
	$_SESSION['_dob'] = mysqli_real_escape_string($link, $_REQUEST['dob']);
	$_SESSION['_type'] = mysqli_real_escape_string($link, $_REQUEST['type']);
	$_SESSION['_address'] = mysqli_real_escape_string($link, $_REQUEST['address']);
	$_SESSION['_mobile'] = mysqli_real_escape_string($link, $_REQUEST['mobile']);
	$_SESSION['_email'] = mysqli_real_escape_string($link, $_REQUEST['email']);
?>
<!--#####-->
<script type="text/javascript">
	function upd(){
		var cond = confirm('Are you sure you want to update?');
		return cond;
	};
	function proc(){
		var updResult = upd();
		if (updResult){
			window.location = "updateAccount2.php";
		}
		else{
			window.location = "editAccount.php";
		}
	};
	proc();
</script>