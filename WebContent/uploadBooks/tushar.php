<?php

$con=mysqli_connect('localhost','hialmora_hello','kNG1pjwm','hialmora_hello');

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

else{
$sql = "select * from tushar";
	 $result = mysqli_query($con,$sql);
	 
	     if(mysqli_num_rows($result)>0){
	     while($row = mysqli_fetch_array($result)) {
		 
		 echo $row['id'];
		 echo '<br><br><br>';

         }
		 }
		 else{
		     return FALSE;
		 }
}