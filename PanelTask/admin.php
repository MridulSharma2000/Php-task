<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);
session_start();

$admin_id = $_SESSION['admin_id'];
if (!isset($admin_id)) {
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



</head>

<body>
  <?php
  // $sql = "SELECT * FROM `userdata` ";
  $sql ="SELECT * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.ID = '$admin_id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $fetch = mysqli_fetch_assoc($result);
  }
  ?>
  <div class="container">

      <h1>WELCOME <span><?php echo $fetch['FIRST NAME'];
                        echo $fetch['LAST NAME']; ?></span>TO ADMIN PAGE</h1>
    
    <div class="view">
      <div class="img">
        <img src="<?php echo $fetch['PATH']; ?>" alt="" height=50px width=50px>
      </div>
      <a class="a" href="userdata.php">VIEW USER DATA</a>
      <br>
      <a class="a1" href="logout.php">LOG OUT</a>
    </div>
  </div>
</body>

</html>