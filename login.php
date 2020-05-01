<?php
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'database';
	$id = 0;

	session_start();
	// Create connection
	$conn = new mysqli($servername, $username, $password, $database);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	//echo "connected to database";
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$ip_email = htmlspecialchars($_REQUEST['email']);
		if (empty($_REQUEST['email'])) {
		    $emialErr = "*E-mail is required";
	  	}
		$ip_password = htmlspecialchars($_REQUEST['password']);
		if (empty($_REQUEST['password'])) {
		    $passwordErr = "*Password is required";
		  }
		$sql = "SELECT email,password FROM user_data WHERE email = '$ip_email'";
		
		
		$result = $conn->query($sql);
		$row_num = $result->num_rows;
		if($row_num == 1){
			$row = $result->fetch_assoc();
				if($row["email"] == $ip_email && $row["password"]==$ip_password){
					//echo "logged in by "."email: ".$row["email"]." password: ".$row["password"]."<br>";
					$sql = "SELECT * FROM user_data where email = '$ip_email'";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
					$id = $row['id'];
					$firstname = $row['firstname'];
					$lastname = $row['lastname'];
					$email = $row['email'];
					$_SESSION['email'] = $email;
					$_SESSION['id'] = $id;
					$password = $row['password'];
					$birthdate = $row['birthdate'];
					$gender = $row['gender'];
					$pass = $row['password'];
					$em = $row['email'];
					echo "$firstname <br>$lastname <br>$email <br>$password <br>$birthdate <br>$gender <br>";
					echo " ana Rabena nasarny"."<br>";
					echo "ID : ".$_SESSION['id']."<br>";
					header("Location:home.php");
					exit();
				}
				//else{
					//if($password != $row['password'])
					//	echo "Wrong password";
					//else
					//	echo "404 - User not found";
					//echo "$password";
				//}
		}
		else{
			//echo "404 - User not found";
		}
	}
	function test_input($data) {
	  	$data = trim($data);
	  	$data = stripslashes($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}
?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login Page</title>
		<link rel="stylesheet" href="style.css">
	</head>
	<body style="background-color: #dddddd;">
		<header class="rectangle">
			<div align="center"><img src="img/Logo.png" alt="logo" class="logo glow" border="2px" height="150px" ></div>
		</header>
		<div align="center">
			<div class="rectangle" style="margin-top: 150px; width: 400px;height:auto ;padding: 20px;background-color: white;">
				<form action="#" method="post">
					<!--<?php echo htmlspecialchars("check.php");?>-->
					<label for="email">E-mail</label>
					<input id="email" name="email" type="text" placeholder="E-mail">
					<label style="color: red;font-size: 12px;"><?php global $emialErr;echo $emialErr ?></label><br>
					<label  for="password">Password</label>
					<input id="password" name="password" type="password" placeholder="password">
					<label style="color: red;font-size: 12px;"><?php global $passwordErr;echo $passwordErr ?></label><br>
					<?php
					global $result; 
					global $row_num;
					global $pass;
					global $ip_email;
					global $em;
						if($row_num != 1 || $row_num == 1){
							
							if($password!=$pass||$ip_email!=$em){
								?>
								<label style="color: red;font-size: 12px;">*E-mail or Password is wrong</label>
								<?php
							}
						}
					?>
					<button id="login" name="login" onClick="window.location.href ='home.php'"; >Login</button>
				</form>
				<button id="newAcc" name="newAcc" onClick="window.location.href ='newAccount.php';" >Create Account</button>
			</div>
		</div>

	</body>
</html>
