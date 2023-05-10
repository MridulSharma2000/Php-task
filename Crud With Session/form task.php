<?php
session_start();
if(isset($_POST["fsave"])){
    if($_POST['fpassword']== $_POST['cpassword']){
        $Name = $_POST['fname'];
        $Surname = $_POST['fsurname'];
        $Username = $_POST['fusername'];
        $Email = $_POST['femail'];
        $Password = $_POST['fpassword'];
        $CPassword = $_POST['cpassword'];
        
        if(count($_SESSION) == 0){
            
            $_SESSION[$Email] = array( $Name,$Surname,$Username,$Email,$Password,$CPassword);
            echo "Data Saved";
        }
        
        foreach ($_SESSION as $key => $value){
            if($key == $Email){
            echo "Email Already Exist";
            }
            else{
                $_SESSION[$Email] = array($Name,$Surname,$Username,$Email,$Password,$CPassword);
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
    <title>Document</title>
    
</head>
<body>
    
    <form action="" method="POST">
       Name: <input type="text" name="fname">
       <br>
       Surname: <input type="text" name="fsurname">
       <br>
       Username: <input type="text" name="fusername">
       <br>
       Email: <input type="email" name="femail" id="">
       <br>
       Password: <input type="password" name="fpassword" id="">
       <br>
       Confirm Password: <input type="password" name="cpassword" id="">
       <br>
       <input type="submit" value="Submit" name="fsave">
       
    </form>
    

  
    </table>
    
    <table border="1" cellpadding="5px">
        <tr>
            <th>Name</th>
            <th>Surname</th>
            <th>Username</th>
            <th>Email</th>
            <th>Password</th>
            <th>Confirm Password</th>
            <th>Delete</th>
            <th>Edit</th>
        </tr>
        <?php
    foreach($_SESSION as  $key => $value){
        echo "<tr>";
        $sno = 0 ;
        for($i=0 ; $i<count($_SESSION[$key]);$i++){
            echo "<td>",$value[$i],"</td>";
        }
        echo '<td><a href = "delete.php?femail=',$value[3],'"> DELETE</a>';
        echo '<td><a href = "update.php?fname=',$value[0],'&fsurname=',$value[1],'&fusername=',$value[2],'&femail=',$value[3],'&fpassword=',$value[4],'&cpassword=',$value[5],'"> UPDATE</a>';
        echo "</tr>";
        // echo '<td>
        //     <form action="Formupdate.php" method="post" id="form">
        //     <input type="text" name="id" value=',$value[0],' hidden>
        //     <input type="text" name="id" value=',$value[0],' hidden>
        //     <input type="text" name="fname" value=', $value[1], ' hidden>
        //     <input type="text" name="lname" value=', $value[2], ' hidden>
        //     <input type="text" name="mail" value=', $value[3], ' hidden>
        //     <input type="text" name="password" value=', $value[4], ' hidden>  
        //     <button type="submit" style="border: none; background: transparent;">edit</button>
        //     </form>
        //     </td>';
        // echo "</tr>";
    }
    ?> 
    </table>
</body>
</html>