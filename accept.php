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
    $t = $_GET['t'];

    $flag = 0;
    $sql = "DELETE FROM requests WHERE requester='$sid' && requestee='$id'";
    $result = $conn->query($sql);

    $sql = "INSERT INTO friends(user1,user2) VALUES ('$id','$sid')";
    $result = $conn->query($sql);
    
    $sql = "INSERT INTO friends(user1,user2) VALUES ('$sid','$id')";
    $result = $conn->query($sql);
    if ($t == '1'||$t == 1) {
        header("Location:requests.php");
    }else{
        header("Location:user.php?id=$sid");
    }

    
?>