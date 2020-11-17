
  <?php
session_start();
  if (!isset( $_SESSION['user_id'])) 
{
  header("Location: admin_login.php");
} 
if($_SESSION['privilege']==3)
{
  header("Location: send-mail.php");
}
   
  $q = intval($_GET['q']);
  
    $selected_val=$_GET['q'];
    
  
  $mysqli=new mysqli("localhost", "rainaveenkrishna", "Nav20sept@", "centre4cm");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
	//$selected_val="all";
   if($selected_val=='unsolved' )
   {
    if($_SESSION['privilege']==1){
    $query = "SELECT * FROM conflict where solution IS NULL";	}
    else{
       $uid=$_SESSION['user_id'];
      $query = "SELECT type FROM resource_person where uid='$uid'";
      $res = mysqli_query($mysqli, $query);
      $row = mysqli_fetch_row($res);
      $type=explode(" ", $row[0]);
      $array=array(0,0,0,0,0,0);
      for($i=0;$i<count($type);$i++){
        $index=$type[$i]-1;
        $array[$index]=intval($type[$i]);
      }
      $query = "SELECT * FROM conflict where solution IS NULL AND (ctype='$array[0]' OR ctype='$array[1]' OR ctype='$array[2]' OR ctype='$array[3]' OR ctype='$array[4]' OR ctype='$array[5]')";
    }
    
  }

  
   
   else if($selected_val=='solved' )
   {
    $query = "SELECT * FROM conflict where approved=1";
   }
   else if($selected_val=='solved_by_me'){
      $uid=$_SESSION['user_id'];
      $query = "SELECT * FROM conflict WHERE solved_by='$uid'";
   }
   else
   {
	 $query = "SELECT * FROM conflict where solution IS NOT NULL AND approved=0 ";  
   }
    $result = mysqli_query($mysqli, $query); 
    
	if (mysqli_num_rows($result) >0)
	{
		
        echo '<div class="w3-row w3-border w3-white">';
        $i=1;
        while ($row = mysqli_fetch_array($result))
	   {
            echo '<div class="w3-third w3-container w3-border-top w3-border-right w3-border-left col-height" style="padding: 10px;">
                  <a style="float: left; margin-left: 1vw;">';
                    echo $row['_date'];
            echo '<br><br>';
                    echo $row['name']; echo ', '; echo $row['state_ut'];
                    echo '<br> Type: '; echo $row['type'];
                    echo '<br> Language: '; echo $row['lang'];
                    if(!is_null($row['sent_on'])){echo '<br> Sent on: '; echo $row['sent_on'];}
                    echo '<br> CONFLICT: '; 
                    
                    echo substr($row['conflict'],0,80); 
                    
                    echo '...';
                    
                    
                    if(!is_null($row['solved_by'])){
                         $uid=$row['solved_by'];
                        $q="SELECT name FROM resource_person WHERE uid='$uid'";
                        $res=mysqli_query($mysqli, $q);
                        if($res){$name= mysqli_fetch_row($res);}
                        echo '<br>Solved by: ';echo $name[0];
                    }
                    
					                    

                    echo '</a>
                    <form method="post" action="view.php" style=""><input type="hidden" name="sno" value="'; echo $row['sno'];
                    if(is_null($row['solution'])){
                    echo '"><input type="submit" name="submit" value="View conflict" style="float: right; margin-right: 1.5vw; margin-bottom: 0vw; border: none;background-color: #e1ad01;color: white;padding: 3px 8px; text-decoration: none;cursor: pointer;"></form>';}
                    else if($row['approved']==1){
                      echo '"></form><form target="_blank" method="post" action="view.php" style=""><input type="hidden" name="sno" value="'; echo $row['sno']; echo '"><a style="float: right; margin-right: 1.5vw; margin-bottom: 0vw;">Sent</a><input type="submit" name="sent" value="View solution" style="float: right; margin-right: 1.5vw; margin-bottom: 0vw; border: none;background-color: #e1ad01;color: white;padding: 3px 8px; text-decoration: none;cursor: pointer;"></form>';
                    }
                    else if($_SESSION['privilege']==1)
					{ echo '"><div style="float: right; margin-right: 1.5vw; margin-bottom: 0vw;"><a >Replied</a><br><input type="submit" id="view_reply" name="view_reply" value="Veiw reply" style="float: right; margin-right: 1.5vw; border: none;background-color: #e1ad01;color: white;padding: 4px 8px; text-decoration: none;cursor: pointer;"></div></form>'; }
                    else { echo '"><input type="submit" name="submit" value="View conflict" style="float: right; margin-right: 1.5vw; margin-bottom: 0vw; border: none;background-color: #e1ad01;color: white;padding: 3px 8px; text-decoration: none;cursor: pointer;"><div style="float: right; margin-right: 1.5vw; margin-bottom: 0vw; "><a >To be approved</a><br></div></form>';
                    }
                    
                    
                    
                    echo '</div>';
                    if($i%3==0){echo '</div><div class="w3-row w-border w3-white">';}
                    $i++;
	 
        
	   }
	   
	   echo '</div>';
	    
	}
	 else
	 {
	    echo "No Conflicts to show";
	 }
	 
		
		
		
		
	   
        mysqli_free_result($result); 
     
    
   
  ?>
