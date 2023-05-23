<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="viewstylesheet.css">
    <title>Document</title>
    <style>
        .heading {
            background-color: skyblue;
            padding: 10px;
            width: 100vh;
            text-align: center;
            border: 3px solid whitesmoke;
            border-bottom-left-radius: 15px;
            border-bottom-right-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container">

        <?php
        
        $select = "SELECT * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.ID = '$user_id' ";

        $result = mysqli_query($conn, $select);

        if (mysqli_num_rows($result) > 0) {
            $fetch = mysqli_fetch_assoc($result);
        }
        ?>

        <div class="heading">
            <h1> WELCOME <br><span><?php echo $fetch['FIRST NAME'];  echo " ";
                                    echo $fetch['LAST NAME']; ?></span></h1>
        </div>
        <div class="view">
            <div class="img">
                <img src="<?php echo $fetch['PATH']; ?>" alt="">
                <br>
            </div>
            <a class="a1" href="usersee.php">YOUR PROFILE</a>
            <a class="a" href="update.php">UPDATE PROFILE</a>
            <br>
            <a class="a1" href="logout.php">LOG OUT</a>
        </div>
    </div>

</body>

</html>