<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);
session_start();
if (isset($_POST['check'])) {
    $email = $_POST['Email'];
    $sql = "SELECT * FROM `userdata` WHERE `EMAIL` = '$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);

        if ($email == $fetch['EMAIL']) {
            $_SESSION['id'] = $fetch['ID'];
            $error[] = "You Entered Correct Email Address";
            header('location:reset.php');
        }
    } else {
        $error[] =  " Email Address Not Found ";
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
        <div class="form">
            <h3>VALIDATE YOUR EMAIL HERE </h3>
            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class = "error">' . $error . '</span>';
                }
            }
            ?>
            <form action="" method="post">

                Check Your Email Validation:<br> <input type="email" name="Email" id="" placeholder="Enter Your Email">
                <br>
                <input class="btn" type="submit" value="CHECK" name="check">
                <br>
                <a href="login.php">Back</a>
            </form>
        </div>
    </div>
    <?php
    // if (isset($_POST['check'])) {
    //     $email = $_POST['Email'];
    //     $sql = "SELECT * FROM `userdata` WHERE `EMAIL` = '$email'";
    //     $result = mysqli_query($conn, $sql);
    //     if (mysqli_num_rows($result) > 0) {
    //         $fetch = mysqli_fetch_assoc($result);

    //         if ($email == $fetch['EMAIL']) {
    //             $_SESSION['id'] = $fetch['ID'];
    //             $error[] = "You Entered Correct Email Address";
    //             header('location:reset.php');


    //         }
    //     } else {
    //         $error[] =  "Please Enter Correct Email Address";
    //     }
    // }
    ?>

</body>

</html>