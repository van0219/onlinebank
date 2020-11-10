<?php 
    session_start();
            
    if(!isset($_SESSION['adminLogin'])){
        header('location:admin_login.php');   
    }
   include 'connection.php';
?>
<!--#####-->
<?php
    $id=  mysqli_real_escape_string($link, $_REQUEST['empID']);
    if ($id >= 1) {
        $query="SELECT * FROM PERSONNEL
        WHERE ID = '$id'";
        $result=  mysqli_query($link, $query) or die(mysqli_error($link));
        $rows=  mysqli_fetch_array($result);
    }
    else{
        header('location:showEmployee.php');
    }
?>
<!--#####-->
<?php
    $id2=  mysqli_real_escape_string($link, $_REQUEST['empID']);
    if(isset($_REQUEST['submit2_ID'])){
        if ($id2 >= 1) {
            $query2="UPDATE PERSONNEL  
                     SET STATUS = 'INACTIVE'
                     WHERE ID = '$id2'";
            mysqli_query($link, $query2) or die(mysqli_error($link));
            header('location:removeEmployee.php');
        }
        else{
            header('location:removeEmployee.php');
        }
    }
?>
<!--#####-->
<?php
    $id3=  mysqli_real_escape_string($link, $_REQUEST['empID']);
    if(isset($_REQUEST['submitAct'])){
        if ($id3 >=1) {
            $query3="UPDATE PERSONNEL
                     SET STATUS = 'ACTIVE'
                     WHERE ID = '$id3'";
            mysqli_query($link, $query3) or die(mysqli_error($link));
            header('location:reactivateEmployee.php');
        }
        else{
            header('location:reactivateEmployee.php');
        }
    }
?>
<!DOCTYPE html> 
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Personnel</title>
    <link rel="stylesheet" type="text/css" href="design.css"/>
</head>
<?php include 'topBar.php'; ?>
<div class='data_newAcc'>
    <?php include 'admin_nav.php'?>
        <div class='newAcc' style="height: 417px;">
            <form action="updateEmployee.php" method="POST">
             <table align='center'>
                <input type="hidden" name="currID" value="<?php echo $id;?>"/>
                 <tr>
                    <td colspan='6' align='center' style='color:#363636;'>
                        <h3><u>Edit Personnel Details</u></h3>
                    </td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="fname" value="<?php echo($rows[1])?>" required=""/></td>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" value="M"<?php if ($rows[4] == 'M') {
                            echo " checked";
                        } ?>/>Male
                        <input style="margin-left: 60px;" type="radio" name="gender" value="F" <?php if ($rows[4]=='F') {
                            echo " checked";
                        } ?>/>Female
                    </td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="mname" value="<?php echo($rows[2]) ?>" /></td>
                    <td>Civil Status</td>
                    <td>
                        <select style="border-radius: 5px; width: 170px;" name="status">
                            <option <?php if ($rows[6] == 'Single') {
                                echo " selected";
                            } ?>>Single</option>
                            <option <?php if ($rows[6] == 'Married') {
                                echo " selected";
                            } ?>>Married</option>
                            <option <?php if ($rows[6] == 'Widowed') {
                                echo " selected";
                            } ?>>Widowed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="lname" required="" value="<?php echo($rows[3]) ?>" /></td>
                    <td>Branch</td>
                    <td>
                        <select style="border-radius: 5px; width: 170px;" name="branch">
                            <option <?php if ($rows[7] == 'Quezon City') {
                                echo " selected";
                            } ?>>Quezon City</option>
                            <option <?php if ($rows[7] == 'Manila City') {
                                echo " selected";
                            } ?>>Manila City</option>
                            <option <?php if ($rows[7] == 'Makati City') {
                                echo " selected";
                            } ?>>Makati City</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        DOB
                    </td>
                    <td>
                        <input style="border-radius: 5px; width: 170px;" type="date" name="dob" value="<?php echo($rows[5]) ?>" required=""/>
                    </td>
                    <td>Mobile</td>
                    <td><input style="border-radius: 5px;" type="text" name="mobile" value="<?php echo($rows[10]) ?>" required=""/></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input style="border-radius: 5px;" type="email" name="email" value="<?php echo($rows[11]) ?>" required=""/></td>
                    <td>Date Hired</td>
                    <td>
                        <input style="border-radius: 5px; width: 170px;" type="date" name="dateHired" value="<?php echo($rows[8]) ?>" required=""/>
                    </td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td><textarea style="border-radius: 5px; width: 170px; text-transform: uppercase;" name="address" required=""><?php echo "$rows[9]"; ?></textarea></td>
                </tr>
                <tr >
                    <td style="border-radius: 5px; padding-top: 30px;" colspan="6" align='center'><input type="submit" name="updEmployee" value="Update Info" class='addEmp_button'/></td>
                </tr>
                </table>
            </form>
        </div>
    </div>
    <?php include 'bot.php' ?>
</body>
</html>
