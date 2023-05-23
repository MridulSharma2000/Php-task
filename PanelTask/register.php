<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);

if (isset($_POST['signup'])) {
    $Firstname = $_POST['fname'];
    $Lastname = $_POST['lname'];
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $createddate = $_POST['created_date'];
    $usertype = "user";

    if (isset($_FILES['image'])) {
        $image = $_FILES['image']['name'];
        $i_size = $_FILES['image']['size'];
        $i_type = $_FILES['image']['type'];
        $i_tmpname = $_FILES['image']['tmp_name'];
        $random = rand(000, 999);
        // $random = str_pad($random,3,'0',STR_PAD_LEFT);
        $name = $random . $image;
        // $date = date('Y-m-d H:i:s');
        // $destination = 'upload/'.$image.$name;
        $destination = 'upload/' . $name;
        move_uploaded_file($i_tmpname, $destination);
    }

    $sql = "SELECT * FROM `userdata` WHERE `EMAIL` = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $error[] = "User Already Exist";
    } else {
        if ($password != $cpassword) {
            $error[] = " Confirm Password Not Matched ";
        } else {
            $register = "INSERT INTO `userdata`( `EMAIL`, `PASSWORD`, `CREATEDDATE`, `USERTYPE`) VALUES ('$email','$cpassword','$createddate','$usertype')";
          $register1 = "INSERT INTO `profile`( `FIRST NAME`, `LAST NAME`) VALUES ('$Firstname','$Lastname')";
            $register2   = "INSERT INTO `imagetable`( `FILESIZE`, `EXTENSION`, `UNIQUENAME`, `NAME`, `PATH`) VALUES ('$i_size',' $i_type ','$i_tmpname','$name','$destination')";



            $upload = mysqli_query($conn, $register);
            $upload1 = mysqli_query($conn, $register1);
            $upload2 = mysqli_query($conn, $register2);

            if ($upload && $upload1 && $upload2) {
                $error[] = "Registered Successfully";
                header('location:login.php');
            } else {
                $error[] = "Registertion Failed";
            }
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
    <title>RegistertionForm</title>
</head>

<body>
    <div class="container">
        <div class="form">
            <form action="" method="post" enctype="multipart/form-data">
                <h3>REGISTER YOURSELF <br> HERE </h3>
                <?php
                if (isset($error)) {
                    foreach ($error as $error) {
                        echo '<span class = "error">' . $error . '</span>';
                    }
                }
                ?>
                <br>
                First Name:<br> <input type="text" name="fname" id="" placeholder="Enter Your First Name" required>
                <br>
                Last Name:<br> <input type="text" name="lname" id="" placeholder="Enter Your Last Name" required>
                <br>
                Email:<br> <input type="email" name="email" id="" placeholder="Enter Your Email" required>
                <br>
                Password:<br> <input type="password" name="password" id="" placeholder="Enter Your Password" required>
                <br>
                Confirm Password:<br> <input type="password" name="cpassword" id="" placeholder="Enter Your Confirm Password" required>
                <br>
                Image:<br> <input type="file" name="image" id="" class="file" >
                <br>
                <input type="hidden" name="created_date" value="<?php echo date('Y-m-d H:i:s'); ?>" readonly="readonly">
                <div>
                    <input class="btn" type="submit" value="Sign Up" name="signup">
                </div>
                <br>
                <span>Already have an Account ?</span>
                <br>
                <a href="login.php">Login </a>
            </form>
        </div>
    </div>
</body>

</html>