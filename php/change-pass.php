<?php
session_start();

if (isset( $_SESSION['user_id'])) 
{
  if($_SESSION['pwd-set']==1){
        header('Location: conflict.php');
      }
  
} 
else{
  header('Location: admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C4CM|Change Password</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <link href="home.css" rel="stylesheet">
    <style>
        #login-card{
    width:25%;
    border-radius: 20px;
    margin:150px auto;

  }
  @media screen and (max-width: 800px){
       #login-card{ width: 80%;}
     }
    #pass, #conf{
    border-radius:30px;
    background-color: #ebf0fc;
    border-color: #ebf0fc;
    color: #9da3b0;
    }

    #button{
    border-radius:30px;
    background-color: #0066ff;

    }

    #container{
    margin-top:25px;
}

    </style>

</head>

<body style="background-color: #f0f1f6;"">

    <!-- navbar-->


    <div class="navbar stripe navbar-expand-lg navbar-light fixed-top">
        <a class="text-white navbar-brand" href="#">CCM</a>
      <!--  <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse"
            data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
            aria-label="Toggle navigation" style="border:0;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">-->
            <div class="navbar-nav" id="sidebar">
                
            </div>
            <div id="toggle-btn" onclick="toggleSidebar(this)">
  <span></span>
  <span></span>
  <span></span>
</div>
        </div>

<div id="login-card" class="card">
<div class="card-body">
  <h2 class="text-center">RESOURCE PORTAL</h2>
  <br>
  <form method="post" onsubmit="check()">
    <div class="form-group">
      <input type="password" class="form-control" id="pass" placeholder="New password" name="password" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="conf" placeholder="Confirm password" name="confirm" required>
    </div>
    <button type="submit" id="button" class="btn btn-primary btn-block " name="change">Change password</button>

  </form>
    </div>
</div>

<?php

/*if (isset( $_SESSION['user_id'])) 
{
  header("Location: home2.php");
}*/

$mysqli=new mysqli("localhost", "rainaveenkrishna", "Nav20sept@", "centre4cm");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

function strength()
  {
    $password=$_POST["password"];
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialChars = preg_match('@[^\w]@', $password);

    if(!$uppercase || !$lowercase || !$number || !$specialChars || strlen($password) < 8) {
    echo '<script>window.alert("Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character."); location.replace="change-pass.php"; </script>';
    }else{
    return true;
    }
  }



  


if(isset($_POST["change"]) && strength())  
 {   
    $uid=$_SESSION['user_id'];
    $uname=$_SESSION['user_name'];
    $password = $_POST["password"]; 
    $privilege=$_SESSION['privilege'];
    $hashed = password_hash($password,PASSWORD_DEFAULT);  
    $query = "INSERT INTO login(uid, user_name, password, privilege) VALUES('$uid', '$uname', '$hashed', '$privilege')";  
    if(mysqli_query($mysqli, $query))  
    {  
        $uid=$_SESSION['user_id'];
      $query2 = "UPDATE resource_person SET pwd_set=1 WHERE uid='$uid'";
      if(mysqli_query($mysqli, $query2)){
      echo '<script>alert("Password has been changed");location.href="Logout.php";</script>'; }
    }  
    else
    {
        echo '<script>alert("Error");location.href="logout.php";</script>';
 } 
    }

?>

<script>
  function check()
  {
    var pass = document.getElementById("pass").value;
    var conf = document.getElementById("conf").value;
    if(pass==conf)
    {
      return true;
    }
    else{
      alert("Passwords do not match");
      return false;
    }
  }
</script>

</body>
</html>