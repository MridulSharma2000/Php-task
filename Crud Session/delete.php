<?php
session_start();
$Email = $_REQUEST['femail'];

foreach ($_SESSION as $key => $value){
    if($Email == $key){
        unset($_SESSION[$key]);
        header('location: form task.php');
    }
}
?>