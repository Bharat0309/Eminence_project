<?php
//this script will handle login 
session_start();
//check if the user is already logged in
if(isset($_SESSION['email']))
{
  header("location: main.php");
  exit;
}
require_once "db.php";
$email = $password = "";
$err ="";

//if server request is post
if($_SERVER['REQUEST_METHOD']== "POST"){

  if(empty(trim($_POST['email'])) || empty(trim($_POST['password']))){

    $err ="please enter email + password";
  }
  else{
    $email = trim($_POST['email']);
    $password=trim($_POST['password']);
  }
 
if(empty($err))
{
  $param_email = $email;
  $sql = "SELECT  email, password  FROM pre_hr_login WHERE  email= ?";
  $stmt= mysqli_prepare($conn, $sql);
  mysqli_stmt_bind_param($stmt, "s", $param_email);


   
  //try to excecute this statment
  if(mysqli_stmt_execute($stmt)){
    mysqli_stmt_store_result($stmt);
    if(mysqli_stmt_num_rows($stmt) ==1){
      mysqli_stmt_bind_param($stmt,$email,$password);
      if(mysqli_stmt_fetch($stmt))
      {
        if(password_verify($password, $password ))
        {
          //this means the password is correct . allow user to login
          session_start();
          $_SESSION["email"] = $email;
          $_SESSION["loggedin"] = $true;
          $_SESSION["id"] = $id;
       
          //redirecting user to mai page
          header("location: main.php");


        }
      }
    }
  }
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pre-HR</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="global.css">
</head>
<body>
    <div class="container ">
        <div class="row justify-content-center"> 
        <div class="col-12 col-sm-6 col-md-3">
                <form class="form-container" method="POST">
                
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                      </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group form-check">
                      <input type="checkbox" class="form-check-input" id="exampleCheck1">
                      <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <div class="form-group">
                        <a href="">Forgot password??</a>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block  ">Submit</button>
                  </form>
            </div>
        </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" 
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" 
integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
