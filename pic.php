<?php
	session_start();
	$id = $_SESSION['id'];
    if (isset($_POST['upload']) && !empty($_FILES["uploadfile"]["name"])) { 
  
	    $filename = $_FILES["uploadfile"]["name"]; 
	    $tempname = $_FILES["uploadfile"]["tmp_name"];     
	        $folder = "img/".$filename; 
	          
	    $db = mysqli_connect("localhost", "root", "", "database"); 
	  
	        // Get all the submitted data from the form 
	        //$sql = "INSERT INTO user_data (profile_picture) VALUES '$filename'"; 
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
  	header("Location:profile.php");
  
?>