<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "panel";

$conn = mysqli_connect($servername,$username,$password,$database);

session_start();

if(isset($_SESSION['user_id']) || isset($_SESSION['admin_id']) ){
    session_destroy();
    header('location:login.php');

}
else{
     (header('location:user.php')  || header('location:admin.php'))  ;
    
}


?>