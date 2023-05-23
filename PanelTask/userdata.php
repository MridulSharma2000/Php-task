<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername, $username, $password, $database);
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="tablestylesheet.css">
  <title>Document</title>
  <style>
  .container{
    height: 100vh;
  }
  </style>
</head>

<body>
  <div class="container">
    <div class="table">
      <div class="heading">
      <h3>USER DATA HERE</h3>
      </div>
      <table border="1" cellpadding="5px">
        <thead>
          <tr>
            <th>S.NO</th>
            <th>USER ID</th>
            <th>FIRST NAME</th>
            <th>LAST NAME</th>
            <th>EMAIL</th>
            <th>PASSWORD</th>
            <th>USERTYPE</th>
            <th>CREADTED DATE</th>
            <th>MODIFIED DATE</th>
            <th>IMAGE</th>
            <th>DELETE</th>
            <th>UPDATE</th>
          </tr>
          <img src="" alt="">
        </thead>
        <tbody>
          <?php
          
          $sql = "SELECT * FROM userdata inner join profile on userdata.ID = profile.ID left join `imagetable` on profile.ID = imagetable.ID WHERE userdata.USERTYPE = 'user'";
          $upload = mysqli_query($conn, $sql);
          $sno = 0;
          while ($row = mysqli_fetch_assoc($upload)) {
            $sno = $sno + 1;
            echo "<tr>
        <td>" . $sno . "</td>
        <td>" . $row['ID'] . "</td>
        <td>" . $row['FIRST NAME'] . "</td>
        <td>" . $row['LAST NAME'] . "</td>
        <td>" . $row['EMAIL'] . "</td>
        <td>" . $row['PASSWORD'] . "</td>
        <td>" . $row['USERTYPE'] . "</td>
        <td>" . $row['CREATEDDATE'] . "</td>
        <td>" . $row['MODIFIEDDATE'] . "</td>
        <td> <img src=", $row['PATH'],  " alt='Image loading...' height=40px width=40px  ></td>
        <td> <a href = 'deletedata.php?id=" . $row['ID'] . "'> DELETE</a></td>
        <td> <a href = 'updatedata.php?id=" . $row['ID'] . "'> UPDATE</a></td>
        </tr>";
          }
          ?>
        </tbody>
      </table>
      <a href="admin.php">Back</a>
    </div>

  </div>
</body>

</html>