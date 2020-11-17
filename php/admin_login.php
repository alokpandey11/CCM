
<?php
session_start();

if (isset( $_SESSION['user_id'])) 
{
  if($_SESSION['pwd-set']==0){
        header('Location: change-pass.php');
      }
  header("Location: conflict.php");
} 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>C4CM|Admin</title>

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
    #uname, #pass{
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
  <h2 class="text-center">ADMIN PORTAL</h2>
  <br>
  <form method="post">
    <div class="form-group">
      <input type="text" class="form-control" id="uname" placeholder="Enter username" name="username" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id="pass" placeholder="Enter password" name="password" required>
    </div>
    <button type="submit" id="button" class="btn btn-primary btn-block " name="login">Login</button>

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

if(isset($_POST['login'])) 
{   
    $uname= $_POST["username"];
    $password= $_POST["password"];
    $query="SELECT * FROM resource_person WHERE user_name = '$uname'";
    $result = mysqli_query($mysqli, $query); 
    $user = mysqli_fetch_array($result);
    $rowcount=mysqli_num_rows($result);
    
    if($rowcount!=1)
    {
        echo "<script type=\"text/javascript\">window.alert('Username or password is incorrect.'); window.location.href = 'admin_login.php';</script>";
    }
    
    if($user['pwd_set']==1){
        $query="SELECT * FROM login WHERE user_name = '$uname'";
        $result = mysqli_query($mysqli, $query); 
        $row = mysqli_fetch_array($result);
      $hash=$row['password'];
      
    if(password_verify($password, $hash))
    {
      $_SESSION['user_id']=$user['uid'];
      $_SESSION['privilege']=$user['privilege'];
      $_SESSION['pwd-set']=1;
      
      if($_SESSION['privilege']==3)
      {
       $_SESSION['pass']=$_POST['password']; 
        header('Location: send-mail.php');
      }
      else{
      header('Location: conflict.php');}
      exit;
  }
    else
    {
        
        echo "<script type=\"text/javascript\">window.alert('Username or password is incorrect.'); window.location.href = 'admin_login.php';</script>";
        
    }
}
else{  
  
if($_POST['password'] == $user['old_pass']) {
  $_SESSION['user_id']=$user['uid'];
  $_SESSION['user_name']=$user['user_name'];
      $_SESSION['privilege']=$user['privilege'];
      $_SESSION['pwd-set']=$user['pwd_set'];    
  header('Location: change-pass.php');}
  else{
    echo "<script type=\"text/javascript\">window.alert('Username or password is incorrect.'); window.location.href = 'admin_login.php';</script>";
    
  }
      }

}


?>


</body>
</html>

