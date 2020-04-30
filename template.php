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
                        <img src="img/male.png" alt="" class="w3-wide glow" height="100px" style="border-radius: 200px;box-shadow: 0 0 10px white;" onClick="window.location.href ='profile.php'"><br><br>
                        <label style="text-align: center;color: white;">FName LName</label>
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
                                        </div>
                </div>
                <div align="center" style="margin-left: -500px">
                        
                </div>
        </div>
</body>

</html>