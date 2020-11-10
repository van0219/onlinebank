<?php 
	session_start();
	if (!isset($_SESSION['accountLogin'])) {
		header('location:main.php');
	}
?>
<?php
	$amount = $_REQUEST['amount'];
	$senderID = $_SESSION['login_id'];
	$receiverID = $_REQUEST['transfer'];
	#####
	include 'connection.php';
	$query = "SELECT MAX(ID)
			  FROM PASSBOOK".$receiverID."    
			  WHERE STATUS = 'ACTIVE'";
	$result = mysqli_query($link, $query) or die(mysqli_error($link));
	$rows = mysqli_fetch_array($result);
	$rLast = $rows[0];//last trans_id  of beneficiary
	#####
	$query2 = "SELECT * FROM PASSBOOK".$receiverID."
			   WHERE ID = '$rLast'";
	$result2 = mysqli_query($link, $query2) or die(mysqli_error($link));
	while ($rows2 = mysqli_fetch_array($result2)) {
		$rAmount = $rows2[9];
		$rfname = $rows2[2];
		$rmname = $rows2[3];
		$rlname = $rows2[4];
		$rBranch = $rows2[5];
		$rBranchCode = $rows2[6];
	}
	#####
	$query3 = "SELECT MAX(ID) FROM PASSBOOK".$senderID;
	$result3 = mysqli_query($link, $query3) or die(mysqli_error($link));
	$rows3 = mysqli_fetch_array($result3);
	$sLast = $rows3[0];//last trans_id in sender
	#####
	$query4 = "SELECT * FROM PASSBOOK".$senderID." WHERE ID='$sLast'";
	$result4 = mysqli_query($link, $query4) or die(mysqli_error($link));
	while ($rows4 = mysqli_fetch_array($result4)) {
		$sAmount = $rows4[9];
		$sfname = $rows4[2];
		$smname = $rows4[3];
		$slname = $rows4[4];
		$sBranch = $rows4[5];
		$sBranchCode = $rows4[6];
	}
	$sTotal = $sAmount - $amount; //sender's Balance
	#####
	if ($sAmount <= 500) {
		echo "<script>alert('Your balance is not enough to proceed with this transaction. You should maintain a minimum of Php 500.00 to your account.');";
		echo "window.location='account_transfer.php';</script>";
	}
	elseif ($amount < 100) {
		echo "<script>alert('Minimum allowable transfer is Php 100.00.');";
		echo "window.location='account_transfer.php';</script>";
	}
	elseif ($sTotal < 500) {
		echo "<script>alert('Your balance is not enough to make this transfer! You should maintain a minimum of Php 500.00 to your account.');";
	}
	else{
		$rTotal = $rAmount + $amount;
		$query5 = "INSERT INTO PASSBOOK".$receiverID." 
				   VALUES(''
				   	     , NOW()
				   	     ,'$rfname'
				   	     ,'$rmname'
				   	     ,'$rlname'
				   	     ,'$rBranch'
				   	     ,'$rBranchCode'
				   	     ,'$amount'
				   	     ,'0'
				   	     ,'$rTotal'
				   	     , CONCAT_WS(' ','FROM','$sfname','$smname','$slname')
				   	 	 ,'ACTIVE')";
		mysqli_query($link, $query5) or die(mysqli_error($link));
		#####
		$sTotal = $sAmount - $amount;
		$query6 = "INSERT INTO PASSBOOK".$senderID." 
				   VALUES(''
				   		 , NOW()
				   		 ,'$sfname'
				   		 ,'$smname'
				   		 ,'$slname'
				   		 ,'$sBranch'
				   		 ,'$sBranchCode'
				   		 ,'0'
				   		 ,'$amount'
				   		 ,'$sTotal'
				   		 , CONCAT_WS(' ','FOR','$rfname','$rmname','$rlname')
				   	     ,'ACTIVE')";
		mysqli_query($link, $query6) or die(mysqli_error($link));
		echo "<script>alert('Transferred Successfully!');";
		echo "window.location='account_transfer.php';</script>";
	}
?>