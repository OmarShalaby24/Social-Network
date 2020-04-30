<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'database';
	$id = 0;

	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "connected to database";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$ip_email = htmlspecialchars($_REQUEST['email']);
		if($ip_email == ''){
			echo"please insert your e-mail";
		}
		$ip_password = htmlspecialchars($_REQUEST['password']);
		if($ip_password == ''){
			echo"please insert your password";
		}
		$sql = "SELECT email,password FROM user_data WHERE email =  \"".$ip_email."\"";
		echo "$sql"."<br>";
		//"'$ip_email'";
		//global $conn;
		//echo $sql;
		$result = $conn->query($sql);
		if($result->num_rows == 1){
			$row = $result->fetch_assoc();
				if($row["email"] == $ip_email && $row["password"]==$ip_password){
					echo "logged in by "."email: ".$row["email"]." password: ".$row["password"]."<br>";
					$sql = "SELECT * FROM user_data where email = '$ip_email'";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
					$email = $row['email'];
					$password = $row['password'];
					$birthdate = $row['birthdate'];
					$gender = $row['gender'];
					echo "$firstname <br>$lastname <br>$email <br>$password <br>$birthdate <br>$gender <br>";
					echo " ana Rabena nasarny"."<br>";
					header("Location:home.php");
			
				}
				else{
					echo "404 - User not found";
				}
		}
		else{
			echo "404 - User not found";
		}
	}
	
?>