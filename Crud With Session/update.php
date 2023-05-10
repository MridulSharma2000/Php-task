<?php
session_start();
$Name = $_REQUEST['fname'];
$Surname = $_REQUEST['fsurname'];
$Username = $_REQUEST['fusername'];
$Email = $_REQUEST['femail'];
$password = $_REQUEST['fpassword'];
$CPassword = $_REQUEST['cpassword'];
if(isset($_REQUEST['update'])){
    $_SESSION[$Email] = array( $Name,$Surname,$Username,$Email,$password,$CPassword);
    header('location: form task.php');
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
     <h2>Data Updation Page</h2>
    <form action="" method="POST">
       Name: <input type="text" name="fname"  value="<?php echo $Name; ?>">
       <br>
       Surname: <input type="text" name="fsurname" value="<?php echo $Surname; ?>">
       <br>
       Username: <input type="text" name="fusername" value="<?php echo $Username; ?>">
       <br>
       Email: <input type="email" name="femail" id="" value="<?php echo $Email; ?>" disabled>
       <br>
       <input type="submit" value="UPDATE" name="update">
       
    </form>
    <?php
    // echo '<a href="forgot password.php?femail=',$value[3],'&fpassword=',$value[4],'">forgot password</a>';
    echo '<td><a href = "forgot password.php?fname=',$Name,'&fsurname=',$Surname,'&fusername=',$Username,'&femail=',$Email,'&fpassword=',$password,'&cpassword=',$CPassword,'">forgot password</a>';
    ?>
    </body>
</html>