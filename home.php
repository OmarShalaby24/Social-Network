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
        $sql = "SELECT * FROM user_data WHERE id = '$id'";
        
        //echo "$sql";

        $result = $conn->query($sql);
        $row_num = $result->num_rows;
        $row = $result->fetch_assoc();
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
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
                        <img src="IMG/male.png" alt="" class="w3-wide glow" height="100px" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px" onClick="window.location.href ='profile.php'"><br><br>
                        <label style="text-align: center;color: white;"><?php echo "$firstname $lastname"; ?></label>
                </div>
                <div class="w3-padding-64 w3-large w3-text-grey"
                        style="font-weight:bold;height: auto;background-color: black;position: sticky;">
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='home.php'" style="color: red!important;border-radius: 10px;background-color: #111111!important;">Home</a>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='profile.php'">Profile</a>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='requests.php'">Friend Requests</a>
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
                                        <button type="button" class="fa fa-search" id="edit" name="edit" style="width:auto;border-radius: 20px" onclick="Edit()"> <label style="color: white;  font-size: 17px">Advanced Search</label></button>
                                </div>
                </div>
                <!-- !Timeline ! -->


                <div align="center" style="margin-left: -500px">
                        <div class="" style="padding: 20px; width:700px">
                            <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px">
                              <div class="w3-container w3-padding">
                                <h6 class="w3-opacity">What's in your mind?</h6>
                                <textarea id="bio" rows="4" name="bio" class="textarea" placeholder="Type here" style="width: 600px" ></textarea>
                                <button type="button" class="w3-button w3-theme" style="width: 120px"><i class="fa fa-pencil"></i> Post</button> 
                                <button type="button" class="w3-button w3-theme" style="width: 120px"><i class="fa fa-camera"></i> Upload</button> 
                              </div>
                            </div>
                        </div>
                        <div class="" style="padding: 20px; width:700px">
                            <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                              <div class="w3-container w3-padding">
                                <img src="IMG/female.png" align="left" width="50">
                                <label align="left">Mayar Adel</label>
                                <text id="bio" rows="4" name="bio" class="textarea" placeholder="Type here" style="width: 600px;">Hello World.</text>
                                <button type="button" class="w3-button w3-theme" style="width: 120px"><i class="fa fa-thumbs-up"></i> Like</button> 
                              </div>
                            </div>
                        </div>
                        <div class="" style="padding: 20px; width:700px">
                            <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                              <div class="w3-container w3-padding">
                                <img src="IMG/female.png" align="left" width="50">
                                <label align="left">Raghda Sallam</label>
                                <text id="bio" rows="4" name="bio" class="textarea" placeholder="Type here" style="width: 600px;">Hello Team.</text>
                                <button type="button" class="w3-button w3-theme" style="width: 120px"><i class="fa fa-thumbs-up"></i> Like</button> 
                              </div>
                            </div>
                        </div>
                        <div class="" style="padding: 20px; width:700px">
                            <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                              <div class="w3-container w3-padding">
                                <img src="IMG/male.png" align="left" width="50">
                                <label align="left">Omar Emara</label>
                                <text id="bio" rows="4" name="bio" class="textarea" placeholder="Type here" style="width: 600px;">First Post on this Website.</text>
                                <button type="button" class="w3-button w3-theme" style="width: 120px"><i class="fa fa-thumbs-up"></i> Like</button> 
                              </div>
                            </div>
                        </div>
                </div>
        </div>
</body>

</html>