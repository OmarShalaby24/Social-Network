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


    if($_SERVER["REQUEST_METHOD"] == "POST"){
    	$ip = htmlspecialchars($_REQUEST['search']);
    }
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
                        <img src="<?php echo $picture ?>" alt="" class="w3-wide glow" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 100px;width: 100px;object-fit: cover;" onClick="window.location.href ='profile.php'"><br><br>
                        <label style="text-align: center;color: white;"><?php echo "$firstname $lastname"; ?></label><br><br><br>
                </div>
        <div class="w3-padding-64 w3-large w3-text-grey"
                style="font-weight:bold;height: auto;background-color: black;position: sticky;">
            <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='home.php'">Home</a>
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
                <form>
                    <div align="left" style="padding-left: 50px;">
                        <label for="search" style="color: white;padding-right: 50px;"><i class="fa fa-search"
                                        style="color: red;"></i> Search</label>
                        <input type="text" id="search" name="search" placeholder="Search"
                                style="width: 700px;padding: 5px;">
                        <button type="button" class="fa fa-search " id="Asearch" name="Asearch"  style="width: auto;color: red!important;border-radius: 10px;background-color: #333333!important;" onclick=""> <label style="color: white;  font-size: 17px">Advanced Search</label></button>
                    </div>
                </form>
            </div>
            <div align="left" style="margin:20px;margin-left: 300px">
                <div class="row" style="content: "";display: table;clear: both">
                    <div>
						<label>First Name :</label>
                        <?php
                        	$sql = "SELECT * FROM user_data WHERE firstname = '$ip'";
                        	$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {?>
                                    <div class="" style="padding: 20px; width:500px">
                                        <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                                          <div class="w3-container w3-padding" align="center">
                                            <img src="<?php echo "IMG/".$row['profile_picture'] ?>" alt="" class="w3-wide glow" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 100px;width: 100px;object-fit: cover;"><br><br>
                                            <a href="user.php?id=<?php echo $row['id'] ?>&name=<?php echo $row['firstname'].' '.$row['lastname'] ?>" class="label" style="text-decoration:none"><?php echo $row['firstname']." ".$row['lastname']; ?></a><br>
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: #00cc00"><i class="fa fa-thumbs-up"></i> Add</button> 
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: red"><i class="fa fa-thumbs-up"></i> Block</button> 
                                            <?php $_SESSION['search_id'] = $row['id'] ?>
                                          </div>
                                        </div>
                                    </div>
                                <?php }
                            } else {?>
                                <label>No User Found</label>
                            <?php }
                        ?>
                    </div><hr style="margin:20px;margin-left: -250px;border-color: #aaaaaa">
                    <div>
        				<label>Last Name :</label>
                        <?php
                        	$sql = "SELECT * FROM user_data WHERE lastname = '$ip'";
                        	$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {?>
                                    <div class="" style="padding: 20px; width:500px">
                                        <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                                          <div class="w3-container w3-padding" align="center">
                                            <img src="<?php echo "IMG/".$row['profile_picture'] ?>" alt="" class="w3-wide glow" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 100px;width: 100px;object-fit: cover;"><br><br>
                                            <a href="user.php?id=<?php echo $row['id'] ?>&name=<?php echo $row['firstname'].' '.$row['lastname'] ?>" class="label" style="text-decoration:none"><?php echo $row['firstname']." ".$row['lastname']; ?></a><br>
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: #00cc00"><i class="fa fa-thumbs-up"></i> Add</button> 
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: red"><i class="fa fa-thumbs-up"></i> Block</button> 
                                            <?php $_SESSION['search_id'] = $row['id'] ?>
                                          </div>
                                        </div>
                                    </div>
                                <?php }
                            } else {?>
                                <label>No User Found</label>
                            <?php }
                        ?>
                    </div><hr style="margin:20px;margin-left: -250px;border-color: #aaaaaa">
                    <div>
        				<label>Email :</label>
                        <?php
                        	$sql = "SELECT * FROM user_data WHERE email = '$ip'";
                        	$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {?>
                                    <div class="" style="padding: 20px; width:500px">
                                        <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                                          <div class="w3-container w3-padding" align="center">
                                            <img src="<?php echo "IMG/".$row['profile_picture'] ?>" alt="" class="w3-wide glow" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 100px;width: 100px;object-fit: cover;"><br><br>
                                            <a href="user.php?id=<?php echo $row['id'] ?>&name=<?php echo $row['firstname'].' '.$row['lastname'] ?>" class="label" style="text-decoration:none"><?php echo $row['firstname']." ".$row['lastname']; ?></a><br>
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: #00cc00"><i class="fa fa-thumbs-up"></i> Add</button> 
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: red"><i class="fa fa-thumbs-up"></i> Block</button> 
                                            <?php $_SESSION['search_id'] = $row['id'] ?>
                                          </div>
                                        </div>
                                    </div>
                                <?php }
                            } else {?>
                                <label >No User Found</label>
                            <?php }
                        ?>
                    </div>
                    <hr style="margin:20px;margin-left: -250px;border-color: #aaaaaa">
                    <div>
        				<label>Phone :</label>
                        <?php
                        	$sql = "SELECT * FROM user_data WHERE phone = '$ip'";
                        	$result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {?>
                                    <div class="" style="padding: 20px; width:500px">
                                        <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                                          <div class="w3-container w3-padding" align="center">
                                            <img src="<?php echo "IMG/".$row['profile_picture'] ?>" alt="" class="w3-wide glow" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 100px;width: 100px;object-fit: cover;"><br><br>
                                            <a href="user.php?id=<?php echo $row['id'] ?>&name=<?php echo $row['firstname'].' '.$row['lastname'] ?>" class="label" style="text-decoration:none"><?php echo $row['firstname']." ".$row['lastname']; ?></a><br>
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: #00cc00"><i class="fa fa-thumbs-up"></i> Add</button> 
                                            <button type="button" class="w3-button w3-theme" style="width: 120px;background-color: red"><i class="fa fa-thumbs-up"></i> Block</button> 
                                            <?php $_SESSION['search_id'] = $row['id'] ?>
                                          </div>
                                        </div>
                                    </div>
                                <?php }
                            } else {?>
                                <label >No User Found</label>
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
    </div>
</body>

</html>