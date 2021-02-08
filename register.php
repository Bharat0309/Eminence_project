<?php
require_once "db.php";
$email = $password = "";

$email_err = $password_err = "";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(empty(trim($_POST["email"]))){
        $email_err = " this field cant be blank ";

    }
    else{
        $sql ="SELECT * FROM pre_hr_login = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt){
            mysqli_stmt_bind_param($stmt, "s",$param_email);

            //set the value of param email
            $param_email = trim($_POST['email']);

            //try to execute
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt)== 1){
                    $email_err = "this email is already registered";
                }
                else{
                    $email = trim($_POST['email']);
                }
            }
        else{
            echo "something went wrong";
        }
        }
    }
    mysqli_stmt_close($stmt);
}

//check for password
if(empty(trim($_POST['password']))){
    $password_err = "password cannot be blank";
}
elseif(strlen(trim($_POST['password'])) > 5){
    $password_err= "password cannot be less then 5 character";
}
else{
    $password = trim($_POST['password']);
}

//check for confrim password

//insert into database
if(empty($email_err) && empty($password_err)){
    $sql= "INSERT INTO pre_hr_login (email, password) VALUES (?,?)";
    $stmt = mysqli_prepare($conn, $sql);
    if($stmt)
    {
        mysqli_stmt_bind_param($stmt,"ss",$param_email, $param_password);
        

        //set these parameter
        $param_email= $email;
    
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        
        //try to execute
        if(mysqli_stmt_execute($stmt)){
            header("location : main.php");
        }
        else{
            echo "something went wrong";
        }
    }
    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>

    <h2> please register here </h2>
    <div class="container mt-5" >
    <form class="row g-3" method="post">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="Email" name="email" class="form-control" id="Email">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="Password" name="password" class="form-control" id="Password">
  </div>


  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</form>
    
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
    -->
  </body>
</html> 