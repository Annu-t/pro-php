<?php

if (isset($_POST['submit'])) {
    //add database connection
    require 'database.php';
    $name =$_POST['name'];
    $pass= $_POST['pass'];
    $confirmpass =$_POST['confirmpass'];
    
    if(empty($name) || empty($pass) || empty($confirmpass)) {

        header("Location: ../register.php?error=emptyfields&name=".$name);
        exit();
    }elseif (!preg_match("/^[a-zA-Z0-9]*/",$name)) {
        header("Location: ../register.php?error=invalidname&name=".$name);
        exit();
    } elseif ($pass !==$confirmpass){

       header("Location: ../register.php?error=passworddonotmatch&name=".$name);
        exit();
    }else 
    {
        $sql = "SELECT name FROM users WHERE name = ?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("Location: ../register.php?error=sqlerror");
        exit();

        } else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $rowCount = mysqli_stmt_num_rows($stmt);

            if ($rowCount >0) {
                header("Location: ../register.php?error=usernametaken");
                exit();
            } else {
                $sql= "INSERT INTO users (name, pass) VALUES (?,?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    header("Location: ../register.php?error=sqlerror");
                exit();

            }else {
                $hashedPass =password_hash($pass, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", $name, $hashedPass);
                mysqli_stmt_execute($stmt);
                header("Location: ../register.php?succes=registered");
                exit();
            }    
        }  
     }

   }
   mysqli_stmt_close($stmt);
   mysqli_close($conn);
}
?>