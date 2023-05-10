<?php
session_start();
$Name = $_REQUEST['fname'];
$Surname = $_REQUEST['fsurname'];
$Username = $_REQUEST['fusername'];
$Email = $_REQUEST['femail'];
$password = $_REQUEST['fpassword'];
$CPassword = $_REQUEST['cpassword'];
if(isset($_REQUEST['update'])){
    $npassword = $_REQUEST['newpassword'];
    $_SESSION[$Email] = array( $Name,$Surname,$Username,$Email,$npassword,$npassword);
    header('location: form task.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>forgot password</title>
</head>
<body>
    <form action="" method="post">
        <label for="">Enter Your Old Password :</label>
        <br>
        <input type="text" name="oldpassword" id="">
        <input type="submit"  name="Check">
    </form>
    <?php
    if(isset($_POST['Check'])){
        if($_POST['oldpassword'] == $password){
    ?>
    <form action="" method="post">
    <label for="">Enter Your New Password</label>
    <br>
    <input type="text" name="newpassword" id="">
    <input type="submit" name="update">
    </form>
      
    <?php
      }
    else{
        echo "Please Enter A Correct Password ";
    }
}
    ?>
    

</body>
</html>