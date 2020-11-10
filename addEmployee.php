<?php 
    session_start();
            
    if(!isset($_SESSION['adminLogin'])) 
        header('location:admin_login.php');   
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Add Personnel</title>       
        <link rel="stylesheet" type="text/css" href="design.css">
    </head>
<?php include 'topBar.php'; ?>
    
        <div class='data_newAcc'>
            <?php include 'admin_nav.php'?>
            <div class='newAcc'>
        <form action="add_Employee.php" method="POST">
             <table align='center'>
                 <tr>
                    <td colspan='6' align='center' style='color:#363636;'>
                        <h3 style="padding-right: 20px;"><u>Add Personnel</u></h3>
                    </td>
                </tr>
                <tr>
                    <td>First Name</td>
                    <td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="fname" required=""/></td>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="gender" value="M" checked/>Male
                        <input style="margin-left: 60px;" type="radio" name="gender" value="F"/>Female
                    </td>
                </tr>
                <tr>
                    <td>Middle Name</td>
                    <td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="mname"/></td>
                    <td>Civil Status</td>
                    <td>
                        <select style="border-radius: 5px; width: 170px;" name="status">
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Last Name</td>
                    <td><input style="border-radius: 5px; text-transform: uppercase;" type="text" name="lname" required=""/></td>
                    <td>Branch</td>
                    <td>
                        <select style="border-radius: 5px; width: 170px;" name="branch">
                            <option>Quezon City</option>
                            <option>Manila City</option>
                            <option>Makati City</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        DOB
                    </td>
                    <td>
                        <input style="border-radius: 5px; width: 170px;" type="date" name="dob" required="" min="1950-01-01" max="2010-01-01" />
                    </td>
                    <td>Mobile</td>
                    <td><input style="border-radius: 5px;" type="text" name="mobile" required=""/></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input style="border-radius: 5px; text-transform: lowercase;" type="email" name="email" required=""/></td>
                    <td>Date Hired</td>
                    <td>
                        <input style="border-radius: 5px; width: 170px;" type="date" name="dateHired" required="" min="1950-01-01" max="2030-01-01"/>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input style="border-radius: 5px;" type="password" name="password" required=""/></td>
                    <td>Address</td>
                    <td rowspan="2"><textarea style="border-radius: 5px; width: 170px; height: 52px;text-transform: uppercase;" name="address" required=""></textarea></td>
                </tr>
                <tr>
                    <td>ReType Password</td>
                    <td><input style="border-radius: 5px;" type="password" name="re_password" required=""></td>
                </tr>
                <tr >
                    <td style="border-radius: 5px; padding-top: 30px; padding-right: 30px;" colspan="6" align='center'><input type="submit" name="addEmployee" value="Add" class='addEmp_button'/></td>
                </tr>
                </table>
        </form>
                </div>
        </div>
    <?php include 'bot.php';?>
    </body>
</html>
