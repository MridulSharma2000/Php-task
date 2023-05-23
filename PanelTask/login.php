<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);
session_start();


if (isset($_POST['login'])) {
    $email = $_REQUEST['email'];
    $password = $_REQUEST['password'];
    $select = "SELECT * FROM `userdata` WHERE EMAIL = '$email' AND PASSWORD ='$password' ";
    $result = mysqli_query($conn, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if ($row['USERTYPE'] == 'admin') {
            $_SESSION['admin_id'] = $row['ID'];
            header('location:admin.php');
        } elseif ($row['USERTYPE'] == 'user') {
            $_SESSION['user_id'] = $row['ID'];
            header('location:user.php');
        }
    } else {
        $error[] = "Incorrect Email OR Password";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #edf75c;
        }

        .loginform {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #bcf75c;
            width: 25%;
            height: 75%;
            text-align: center;
            border: 5px solid white;
            border-radius: 15px;
            font-size: 17px;
            padding-top: 45px;
        }

        .loginform h3 {
            font-family: 'Times New Roman', Times, serif;
            font-size: 25px;
            padding: 5px 12px;
            margin: 10px 5px;
        }

        .loginform a {
            text-decoration: none;
            color: blue;
            padding: 2px;
        }
        .loginform a:hover {
            background-color: whitesmoke;
            color: black;
            border-radius: 10px;
        }

        .loginform input {
            margin: 10px;
            padding: 5px 25px;
            border: 2px solid lightseagreen;
            border-radius: 10px;
            text-align: center;

        }

        .loginform .btn {
            color: black;
            background-color: lightseagreen;
            border: 2px solid white;
            padding: 5px 10px;
        }

        .loginform form {
            margin-top: 10px;
        }

        .loginform .btn:hover {
            color: whitesmoke;
            background-color: darkolivegreen;

        }
    </style>
</head>

<body>
    <div class="container">
        <div class="loginform">
            <h3> LOGIN HERE</h3>

            <?php
            if (isset($error)) {
                foreach ($error as $error) {
                    echo '<span class = "error">' . $error . '</span>';
                }
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">

                Email:<br> <input type="email" name="email" id="">
                <br>
                Password:<br> <input type="password" name="password" id="">
                <br>
                <a href="forget.php">Forget Password ?</a>
                <br>
                <input class="btn" type="submit" value="Login Now" name="login">
                <br>
                <span>Don't Have An Account Yet ?</span>
                <br>
                <a href="register.php">Sign up </a>
            </form>
        </div>
    </div>
</body>

</html>