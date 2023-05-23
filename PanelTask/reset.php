<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);
session_start();
$user_id = $_SESSION['id'];
if (!isset($user_id)) {
    header('location:forget.php');
}

if (isset($_POST['Rest'])) {
    $id = $user_id;
    $new_password = $_POST['newpassword'];
    $confirm_password = $_POST['confirmnewpassword'];
    $modifieddate = $_POST['modified_date'];
   
    if (!empty($new_password) || !empty($confirm_password)) {
        if (($new_password != $confirm_password)) {
            $error[] =  "Confirm Password Not Matched";
        } else {
            $update = "UPDATE `userdata` SET  `PASSWORD`='$confirm_password',`MODIFIEDDATE` = '$modifieddate' WHERE `ID` = '$id'";
            $error[] =  "Password Updated Successfully";
            $upload = mysqli_query($conn, $update);
            if ($upload) {
                $error[] =  "Updated Succesfully";
            } else {
                $error[] =  "Not Updated";
            }
        }
    }
    else{
        $error[] = "Please Enter Values";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formstylesheet.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <?php
        $select = "SELECT * FROM `userdata` WHERE `ID` = '$user_id' ";

        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
        }
        ?>
        <div class="form">
        <h3>RESET YOUR PASSWORD HERE </h3>
        <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class = "error">'.$error.'</span>';
                }
            }
            ?>
            <form action="" method="post">
                Email:<br> <input type="email" name="newemail" value="<?php echo $fetch['EMAIL'];
                                                                        ?>" disabled>
                <br>
                <input type="hidden" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly="readonly">
                New Password :<br> <input type="password" name="newpassword" placeholder="Enter New  Password ">
                <br>
                Confirm New Password :<br> <input type="password" name="confirmnewpassword" placeholder="Enter Confirm Password ">
                <br>
                <input class ="btn" type="submit" value="RESET" name="Rest">
                <br>
                <a href="login.php">Back</a>
            </form>
        </div>
    </div>
</body>

</html>