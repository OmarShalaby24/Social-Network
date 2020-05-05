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
        $email = $_SESSION['email'];
        $id = $_SESSION['id'];
        //echo "$id"."<br>";
        //echo $email."<br>";
        $sql = "SELECT * FROM user_data WHERE id = '$id'";

        $result = $conn->query($sql);
        $row_num = $result->num_rows;
        $row = $result->fetch_assoc();

        $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $password = $row['password'];
        $email = $row['email'];
        $birthdate = explode('-', $row['birthdate']);
        //read date from the database
        //echo "month : $birthdate[1]"."<br>";
        $day = $birthdate[2];
        $month = $birthdate[1];
        $year = $birthdate[0];
        $profile_picture = $row['profile_picture'];
        $hometown = $row['hometown'];
        $status = $row['marital_status'];
        $bio = $row['about_me'];
        $gender = $row['gender'];
        $phone = $row['phone'];
        $picture = "img/".$row['profile_picture'];
?>

<!DOCTYPE html>
<html>

<head>
        <meta charset="utf-8">
        <title>Home</title>
        <link rel="stylesheet" href="style.css">

        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>

<body style="background-color: #dddddd;">
        <nav class="w3-sidebar w3-bar-block w3-collapse w3-top rectangle"
        style="width:300px;background-color: black;"  id="Sidebar">
                <div class="w3-container w3-display-container w3-padding-16"
                style="margin-top: 10px;background-color: black;margin-top: -0px;" align="center">
                        <i onclick="w3_close()" class="fa fa-remove w3-hide-large w3-button w3-display-topright;"
                                style="background-color: white;"></i>
                        <img src="<?php echo $picture; ?>" alt="" class="w3-wide glow image" style="width: 100px;height: 100px;object-fit: cover;border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px"><br><br>
                        <label style="text-align: center;color: white;"><?php echo "$firstname $lastname" ?></label><br><br><br>
                </div>
                <div class="w3-padding-64 w3-large w3-text-grey"
                        style="font-weight:bold;height: auto;background-color: black;position: sticky;">
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='home.php'">Home</a>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='profile.php'">Profile</a>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='requests.php'"  style="color: red!important;border-radius: 10px;background-color: #111111!important;">Friend Requests</a>
                        <br><br><br><br><br><br><br>
                        <a href="#" class="sidebar-item sidebar-button label" style="margin-bottom: 38px;"onClick="window.location.href ='login.php'">Logout</a>
                </div>
        </nav>

        <!-- !PAGE CONTENT! -->
        <!-- !SEARCH BOX -->
        <div class="w3-main" style="margin-left:300px;">
                <div class="rectangle sticky"  style="height: auto;box-shadow: none;">
                                <div align="left" style="padding-left: 50px;">
                                        <label for="search" style="color: white;padding-right: 50px;"><i class="fa fa-search"
                                                        style="color: red;"></i> Search</label>
                                        <input type="text" id="search" name="search" placeholder="Search"
                                                style="width: 700px;padding: 5px;">
                                        <button type="button" class="fa fa-search" id="edit" name="edit" style="width: auto;border-radius: 20px" onclick="Edit()"> <label style="color: white;font-size: 17px">Advanced Search</label></button>
                                </div> 
                </div>
                <div align="center">
                        
                </div>
        </div>
</body>

</html>