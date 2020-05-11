<?php
	session_start();
    if(!isset($_SESSION['id'])){
        header("Location:error.php");
    }
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'database';
    $conn = new mysqli($servername, $username, $password, $database);
    // Check connection
    if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
    }
    $id = $_SESSION['id'];
    $sid = $_GET['id'];

    $flag = 0;
    $sql = "SELECT * FROM friends";
    $result = $conn->query($sql);
    while ($row=$result->fetch_assoc()) {
    	if($row['requester']==$id && $row['requestee']==$sid){
    		$flag = 1;
    		break;
    	}
    }
    if($flag==0){
	    $sql = "INSERT INTO friends (requester,requestee) VALUES ('$id','$sid')";
	    $conn->query($sql);
    }
    header("Location:user.php?id=$sid");

    
?>