<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);
session_start();

$user_id = $_SESSION['user_id'];


if (isset($_POST['update'])) {
    $nfname = $_POST['newfirstname'];
    $nlname = $_POST['newlastname'];
    $modifieddate = $_POST['modified_date'];


    $updatename = "UPDATE `profile` SET `FIRST NAME`='$nfname',`LAST NAME`='$nlname' WHERE ID = '$user_id'";
    $mod = "UPDATE `userdata` SET `MODIFIEDDATE`='$modifieddate' WHERE ID = '$user_id'";

    $upload = mysqli_query($conn, $updatename);
    $upload1 = mysqli_query($conn, $mod);
    if ($upload && $upload1) {
        $error[] =  "First And Last Name Updated Succesfully";
    }
}


if (isset($_POST['update'])) {
    $old_password = $_POST['oldpassword'];
    $update_password = $_POST['updatepassword'];
    $new_password = $_POST['newpassword'];
    $confirm_password = $_POST['confirmnewpassword'];
    $modifieddate = $_POST['modified_date'];

    if (!empty($update_password) || !empty($new_password) || !empty($confirm_password)) {
        if ($update_password != $old_password) {
            $error[] =  "Old Password Not Matched";
        } elseif (($new_password != $confirm_password)) {
            $error[] =  "Confirm Password Not Matched";
        } else {

            $updatepass = "UPDATE `userdata` SET `PASSWORD`='$confirm_password',`MODIFIEDDATE`='$modifieddate' WHERE ID = '$user_id'";
            $passupload = mysqli_query($conn, $updatepass);
            if ($passupload) {
                $error[] =  "Password Updated Successfully";
            }
        }
    }
}

if (isset($_FILES['file'])) {
    $modifieddate = $_POST['modified_date'];
    $newimage = $_FILES['file']['name'];
    $newi_size = $_FILES['file']['size'];
    $newi_type = $_FILES['file']['type'];
    $newi_tmpname = $_FILES['file']['tmp_name'];
    $random = rand(000, 999);
    // $random = str_pad($random,3,'0',STR_PAD_LEFT);
    $name = $random . $newimage;
    // $date = date('Y-m-d H:i:s');
    // $destination = 'upload/'.$image.$name;
    $destination = 'upload/' . $name;
    // $destination = 'upload/' . $newimage;
    move_uploaded_file($newi_tmpname, $destination);
    if (!empty($newimage)) {
        $updateimage = "UPDATE `imagetable` SET `FILESIZE`='$newi_size',`EXTENSION`='$newi_type',`UNIQUENAME`='$newi_tmpname',`NAME`='$name',`PATH`='$destination' WHERE ID = '$user_id'";
        $modf = "UPDATE `userdata` SET `MODIFIEDDATE`='$modifieddate' WHERE ID = '$user_id'";
        $imageupload = mysqli_query($conn, $updateimage);
        $modfupload = mysqli_query($conn, $modf);
        if ($imageupload && $modfupload) {
            $error[] =  "Image Updated Successfully";
        } else {
            $error[] =  "Not Updated";
        }
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

        
        $select = "SELECT * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.ID = '$user_id'";

        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
        }
        ?>
        <div class="form">
            <div class="heading">
                <h3> UPDATE YOUR DATA HERE </h3>
            </div>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class = "error">' . $error . '</span>';
                }
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                First Name:<br> <input type="text" name="newfirstname" value="<?php echo $fetch['FIRST NAME']; ?>">
                <br>
                Last Name:<br> <input type="text" name="newlastname" value="<?php echo $fetch['LAST NAME']; ?>">
                <br>
                Email:<br> <input type="email" name="newemail" value="<?php echo $fetch['EMAIL']; ?>" disabled>
                <br>
                Image: <br> <input type="file" name="file"><br>
                <img src="<?php echo $fetch['PATH']; ?>" alt="image not found" height=50px width=50px>
                <br>
                <input type="hidden" name="oldpassword" value="<?php echo $fetch['PASSWORD']; ?>">
                <input type="hidden" name="modified_date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly="readonly">
                Old Password :<br> <input type="password" name="updatepassword" placeholder="Enter Old Password ">
                <br>
                New Password :<br> <input type="password" name="newpassword" placeholder="Enter New  Password ">
                <br>
                Confirm New Password :<br> <input type="password" name="confirmnewpassword" placeholder="Enter Confirm Password ">
                <br>
                <br>
                <input class="btn" type="submit" value="UPDATE" name="update">
                <br>
                <a href="user.php">Back</a>
            </form>
        </div>
    </div>


</body>

</html>