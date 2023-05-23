<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);

session_start();


if (isset($_SESSION['admin_id'])) {
    $id = $_SESSION['admin_id'];
    $sql = "SELECT * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.ID = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $fetch = mysqli_fetch_assoc($result);
    }

    if ($fetch['USERTYPE'] == 'admin') {
        if (isset($_REQUEST['id'])) {
            $ID = $_REQUEST['id'];
        }
        $sql = "DELETE FROM `userdata` WHERE `ID` = '$ID'";
        $sql2 = "DELETE FROM `imagetable` WHERE `ID` = '$ID'";
        $sql1 = "DELETE FROM `profile` WHERE `ID` = '$ID'";
        $delete = mysqli_query($conn, $sql);
        $delete1 = mysqli_query($conn, $sql1);
        $delete2 = mysqli_query($conn, $sql2);
        header('location:userdata.php');
    }
    elseif($fetch['USERTYPE'] == 'user'){
        echo "Sorry You Haven't Permission to Delete Any Data";
        header('location:usersee.php');
    }
    echo "Sorry You Haven't Permission to Delete Any Data";
}
echo "Sorry You Haven't Permission to Delete Any Data";










die();

if (isset($_REQUEST['id'])) {
    $ID = $_REQUEST['id'];
}

$sql = "SELECT * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.ID = '$ID'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $fetch = mysqli_fetch_assoc($result);
}


if ($fetch['USERTYPE'] == 'admin') {

    $sql = "DELETE FROM `userdata` WHERE `USERTYPE` = 'user'";
    $sql2 = "DELETE FROM `imagetable` WHERE `USERTYPE` = 'user'";
    $sql1 = "DELETE FROM `profile` WHERE `USERTYPE` = 'user'";

    $delete = mysqli_query($conn, $sql);
    $delete1 = mysqli_query($conn, $sql1);
    $delete2 = mysqli_query($conn, $sql2);
    header('location:userdata.php');
} else {
    echo "You have't Permission to delete Any Data";
}



die();


if (isset($_REQUEST['id'])) {
    $ID = $_REQUEST['id'];
}

$sql = "SELECT * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.ID = 'ID'";

$upload = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($upload);

print_r($row['USERTYPE']);
die();







$sql = "DELETE FROM `userdata` WHERE `ID` = '$ID'";
$sql2 = "DELETE FROM `imagetable` WHERE `ID` = '$ID'";
$sql1 = "DELETE FROM `profile` WHERE `ID` = '$ID'";
// $sql = "DELETE * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.ID = '$ID'";

$delete = mysqli_query($conn, $sql);
$delete1 = mysqli_query($conn, $sql1);
$delete2 = mysqli_query($conn, $sql2);
header('location:userdata.php');
