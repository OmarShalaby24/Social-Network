<?php
	session_start();
	$id = $_SESSION['id'];
	$db = mysqli_connect("localhost", "root", "", "database");
	$sql = "SELECT firstname,lastname FROM user_data WHERE id = '$id'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$firstname = $row['firstname'];
	$lastname = $row['lastname'];

	$text = htmlspecialchars($_REQUEST["caption"]);

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		if(!empty($text) || !empty($_FILES["imageUpload"]["name"])){
			
			$isPublic = htmlspecialchars($_REQUEST["isPublic"]);
			
			//echo isset($_POST['post']);
			$t = empty($_FILES["imageUpload"]["name"]);
			//$t = false;
			if (isset($_POST['post']) && !empty($_FILES["imageUpload"]["name"])) { 
			    $filename = $_FILES["imageUpload"]["name"]; 
			    $tempname = $_FILES["imageUpload"]["tmp_name"];
				$folder = "IMG/".$filename; 
				echo "$folder"."<br>";
		  		
		        // Get all the submitted data from the form 
		  		$sql = "INSERT INTO posts (user_id,caption,image,isPublic) VALUES ('$id','$text','$filename','$isPublic')";
		        // Execute query 
		        mysqli_query($db, $sql); 
		          
		        // Now let's move the uploaded image into the folder: image 
		        if (move_uploaded_file($tempname, $folder))  { 
		            echo "Image uploaded successfully"; 
		        }else{ 
		            echo "Failed to upload image"; 
		      	}
	  		}
		}
	}
	header("Location:home.php");
	exit();
?>