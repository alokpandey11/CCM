
<?php

	if(!isset($_POST['submit']))
	{
		header("Location: share.html");
	}

$mysqli=new mysqli("localhost", "rainaveenkrishna", "Nav20sept@", "centre4cm");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
	
	$query = "SELECT identity FROM conflict";
    $result = mysqli_query($mysqli, $query);
    if ($result) 
    {  
        $row = mysqli_num_rows($result);
        $row=$row+2;
     }
     else{
         $row=1;
     }
     

	$name= $_POST["name"];
	$email= $_POST["email"];
	$phno= $_POST["phone_number"];
	$state= $_POST["state"];
	$city= $_POST["city"];
	$id= $_POST["identity"];
	$type= $_POST["conflict_type"];
	$lang= $_POST["language"];
	$conflict= mysqli_real_escape_string($mysqli, $_POST["conflict"]);
	$date=date('yy-m-d');
	$time=date('h:i:s');

  if($type=='conflict between multiple options'){ $ctype=1;}
  else if($type=='conflict between heart and mind'){ $ctype=2;}
  else if($type=='conflict with family'){ $ctype=3;}
  else if($type=='conflict at workplace'){ $ctype=4;}
  else if($type=='conflict in other relationships'){ $ctype=5;}
  else { $ctype=6;}



	$sql="INSERT INTO conflict(sno, _date, _time, name, email, phone_num, state_ut, city, identity, type, ctype, lang, conflict) VALUES ('$row', '$date', '$time', '$name', '$email', '$phno', '$state', '$city', '$id', '$type', '$ctype', '$lang', '$conflict')";
	$result=mysqli_query($mysqli, $sql);
if(!$result){
	echo("Error description: " . mysqli_error($mysqli));}
?>
  
  

<html>
<head>
  <meta charset="UTF-8" />
  <meta name="description"
    content="The Centre for Conflict Management is a not-for-profit, voluntary initiative for creating a peaceful, inclusive and vibrant world under the able guidance and mentorship of world-renowned expert in negotiation and conflict management Prof. Himanshu Rai, Director, IIM Indore. Developed by @codersaty and Nikhil shukla Madan Mohan Malaviya University of Technology(MMMUT)." />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>C4CM|Join us</title>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous" />
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
    integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous" />

  <link href="home.css" rel="stylesheet" />
  <link href="share.css" rel="stylesheet" />
</head>

<body>
  <!-- navbar-->
 <div class="container-fluid">
    <nav class="navbar stripe navbar-expand-lg navbar-light fixed-top">
      <a class="text-white navbar-brand" href="index.html">CCM</a>
      <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation" style="border: 0;">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="text-white nav-item nav-link active" href="index.html">Home <span
              class="sr-only">(current)</span></a>
          <a class="nav-item nav-link text-white" href="index.html#aboutuselement">About</a>
          <a class="nav-item nav-link text-white" href="gallery.html">Gallery</a>
          <a class="nav-item nav-link text-white" href="index.html#ourteamelement">Our Team</a>
          <a class="nav-item nav-link text-white" href="index.html#contactelement">Contact</a>
          <a class="nav-item nav-link text-white" href="FAQ.html#">FAQ</a>
        </div>
      </div>
    </nav><br/><br/><br/><br/>

     <div class="container">
        <div class="row justify-content-center">
          <div class="col-auto contentclass">
          	

          	<h2>Thanks for Contacting us..!</h2>
          	<h2> We Will Contact You Soon..."</h2>
          	<br/>
          	<a href="index.html"><input type="button" value="Home" style="background-color: #4ea8de; border: solid #4ea8de; border-radius: 5px; padding: 5px;"></a><br/><br/><a href="share.html"><input type="button" value="Share another conflict" style="background-color: #4ea8de; border: solid #4ea8de; border-radius: 5px; padding: 5px;"></a></button><br/><br/>

          
          </div>
      </div>
  </div></div>


     <footer class="blog-footer text-center" id="footer" style="bottom: 0; position: fixed;">
    <p class="footer-icons">
      <a href="http://linkedin.com/in/centre4cm" target="_blank"><i class="fa fa-linkedin"></i></a>
      <a href="https://twitter.com/centre4cm" target="_blank"><i class="fa fa-twitter"></i></a>
      <a href="https://www.facebook.com/centre4cm/" target="_blank"><i class="fa fa-facebook"></i></a>
      <a href="https://www.instagram.com/centre4cm/" target="_blank"><i class="fa fa-instagram"></i></a>
    </p>
    <p>&copy; 2020 Centre for Conflict Management.</p>
    <p>
      <a href="#">Back to top</a>
    </p>
    <p>
      Disclaimer: The responses given by our resource persons are based on
      their learnings and experience. They should, by no means, be taken as a
      substitute for medical/professional help.
    </p>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <!--  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
          integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
          crossorigin="anonymous"></script> -->
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>


</body>
</html>';
