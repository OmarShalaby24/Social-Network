<?php
	$mysqli = new mysqli("localhost","root","","database");
	
	if ($mysqli -> connect_errno) {
	  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
	  exit();
	}
	
	$sql = "SELECT * FROM user_data ORDER BY fin";
	$result = mysqli_query($mysqli,$sql);
	
	if ($result->num_rows > 0) {
  	// output data of each row
  		while($row = $result->fetch_assoc()) {
    	echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  	}
	} else {
  		echo "0 results";
	}

   	mysqli_free_result($result);
   	mysqli_close($mysqli);
?>