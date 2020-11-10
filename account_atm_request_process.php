<?php
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<!--#####-->
<?php
	include 'connection.php';
	$name = $_SESSION['name'];
	$accNum = $_SESSION['login_id'];
	$option = $_REQUEST['select'];
	#####
	$atmStatus = $checkStatus = "NOT REQUESTED";
	if ($option == 'ATM') {
		$atmStatus = "PENDING";
	}
	else{
		$checkStatus = "PENDING";
	}
	#####
	$query = "SELECT ACCNUM 
					,STATUS
			  FROM CHECKBOOK 
			  WHERE ACCNUM = '$accNum'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$rows = mysqli_fetch_array($result);
	$statusCheck = $rows[1];
	$id = $rows[0];
	#####DATE_FORMAT(DATE, '%a %D %b %Y')
	$readyCheckQuery = "SELECT DATE_FORMAT(DATE_ADD(DATE(`DATE_ISSUED`), INTERVAL 7 DAY), '%a %D %b %Y')
				 		FROM CHECKBOOK
					    WHERE ACCNUM = '$id'";
	$readyCheckQueryResult = mysqli_query($link, $readyCheckQuery) or die(mysqli_error($link));
	$readyCheckQueryRows = mysqli_fetch_array($readyCheckQueryResult);
	$readyCheck = $readyCheckQueryRows[0];
	#####
	$query2 = "SELECT ACCNUM 
					 ,STATUS
					 ,DATE_ISSUED
			   FROM ATM 
			   WHERE ACCNUM = '$accNum'";
	$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
	$rows2 = mysqli_fetch_array($result2);
	$statusAtm = $rows2[1];
	$id2 = $rows2[0];
	#####
	$readyAtmQuery = "SELECT DATE_FORMAT(DATE_ADD(DATE(`DATE_ISSUED`), INTERVAL 7 DAY), '%a %D %b %Y')
				 	  FROM ATM
				 	  WHERE ACCNUM = '$id2'";
	$readyAtmQueryResult = mysqli_query($link, $readyAtmQuery) or die(mysqli_error($link));
	$readyAtmQueryRows = mysqli_fetch_array($readyAtmQueryResult);
	$readyAtm = $readyAtmQueryRows[0];
	#####
	if (($option=='ATM' && $statusAtm=='PENDING') || ($option=='Cheque' && $statusCheck=='PENDING')) {
		echo "<script>alert('Request is still in process!');</script>";
		echo "<script>window.location = 'account_atm_request.php';</script>";
	}
	elseif (($option=='ATM' && $statusAtm=='ISSUED') || ($option=='Cheque' && $statusCheck=='ISSUED')) {
		if ($option == 'ATM') {
			echo "<script>alert('You can claim your card at the branch by $readyAtm.');</script>";
			echo "<script>window.location = 'account_atm_request.php';</script>";
		}
		else{
			echo "<script>alert('You can claim your cheque book at the branch by $readyCheck.');</script>";
			echo "<script>window.location = 'account_atm_request.php';</script>";
		}
	}
	elseif ($option == 'ATM') {
		$query3 = "INSERT INTO ATM
				  VALUES(''
						,'$name'
						,'$accNum'
						,'$atmStatus'
						, NOW()
						,'')";
		mysqli_query($link, $query3) or die(mysqli_error($link));
		echo "<script>alert('You have successfully submitted your request for an atm card. Kindly wait for the confirmation message from the bank. Thank you!');</script>";
		echo "<script>window.location = 'account_atm_request.php';</script>";
	}
	else{
		$query4 = "INSERT INTO CHECKBOOK
				   VALUES(''
				         ,'$name'
				         ,'$accNum'
				         ,'$checkStatus'
				     	 , NOW()
				     	 ,'')";
		mysqli_query($link, $query4) or die(mysqli_error($link));
		echo "<script>alert('You have successfully submitted your request for a checkbook. Kindly wait for the confirmation message from the bank. Thank you!');</script>";
		echo "<script>window.location = 'account_atm_request.php';</script>";
	}
?>