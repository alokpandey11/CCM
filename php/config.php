<?php
    $mysqli=new mysqli('localhost', 'root', '', 'centre4cm');
  if ($mysqli->connect_error) {
      die("Connection failed: " . $mysqli->connect_error);
    }
 ?>