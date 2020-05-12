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
    $sql = "DELETE FROM friends WHERE user1='$sid' && user2='$id'";
    $result = $conn->query($sql);
    $sql = "DELETE FROM friends WHERE user1='$id' && user2='$sid'";
    $result = $conn->query($sql);
    header("Location:user.php?id=$sid");

    
?>