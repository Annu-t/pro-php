<?php
if(isset($_POST['submit'])){
    require 'database.php';

    $name=$_POST['name'];
    $pass=$_POST['pass'];
    if (empty($name)|| empty($pass)){
        header("Location: ../index.php?error=emptyfields");
    exit();
    }else{
        $sql= "SELECT * FROM users WHERE name=?";
        $stmt =mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
    exit();

        }else {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            $result=mysqli_stmt_get_result($stmt);
            if ($row =mysqli_fetch_assoc($result)){

              $passCheck =password_verify($pass, $row['pass']); 
              if($passCheck==false){
                header("Location: ../index.php?error=wrongpass");
                exit();

              }elseif ($passCheck==true){

                session_start();
                $_SESSION['name']= $row['name'];
                $_SESSION['pass']=$row['pass'];
                header("Location: ../index.php?success=loggedin");
                  exit();

              } else {
                header("Location: ../index.php?error=wrongpass");
                exit();
              }
              
            }else {
                header("Location: ../index.php?error=nouser");
                  exit();
            }

        }
    }

}else {
    header("Location: ../index.php?error=accessforbidden");
    exit();
}

?>