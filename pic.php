<?php
	session_start();
	$id = $_SESSION['id'];
	$gender = $_SESSION['gender'];
	$db = mysqli_connect("localhost", "root", "", "database");
    if (isset($_POST['upload']) && !empty($_FILES["uploadfile"]["name"])) { 
  
	    $filename = $_FILES["uploadfile"]["name"]; 
	    $tempname = $_FILES["uploadfile"]["tmp_name"];
		$folder = "img/".$filename; 
	          
	    
	  
	        // Get all the submitted data from the form 
	  		$sql = "UPDATE user_data SET profile_picture = '$filename' WHERE id = '$id'";
	        // Execute query 
	        mysqli_query($db, $sql); 
	          
	        // Now let's move the uploaded image into the folder: image 
	        if (move_uploaded_file($tempname, $folder))  { 
	            echo "Image uploaded successfully"; 
	            echo "test";
	        }else{ 
	            echo "Failed to upload image"; 
	      	}
  	} 
  	elseif (isset($_POST['remove'])) {
  		$sql = "SELECT gender FROM user_data WHERE id ='$id'";
  		$result = $db->query($sql);
  		$row = $result->fetch_assoc();
  		if($gender == 'Male'){
  			$sql = "UPDATE user_data SET profile_picture = 'male.png' WHERE id = '$id'";
  			mysqli_query($db, $sql); 
  		}
  		else{
  			$sql = "UPDATE user_data SET profile_picture = 'female.png' WHERE id = '$id'";
  			mysqli_query($db, $sql);
  		}

  	}
  	header("Location:profile.php");
  	exit();
  
?>