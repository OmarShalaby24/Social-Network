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
    $picture = "img/".$row['profile_picture'];
    
    $sid = $_GET['id'];

    //echo "---------------------------------------------------------$sid";
    $sql = "SELECT * FROM user_data WHERE id = '$sid'";
    $sresult = $conn->query($sql);
    $srow = $sresult->fetch_assoc();

    $sid = $srow['id'];
    $sfirstname = $srow['firstname'];
    $slastname = $srow['lastname'];
    $spassword = $srow['password'];
    $semail = $srow['email'];
    $sbirthdate = $srow['birthdate'];
    //read date from the database
    //echo "month : $birthdate[1]"."<br>";
    //$sday = $birthdate[2];
    //$smonth = $birthdate[1];
    //$syear = $birthdate[0];
    $sprofile_picture = $srow['profile_picture'];
    $shometown = $srow['hometown'];
    $sstatus = $srow['marital_status'];
    $sbio = $srow['about_me'];
    $sgender = $srow['gender'];
    //s$_SESSION['gender'] = $gender;
    $sphone = $srow['phone'];
    $spicture = "img/".$srow['profile_picture'];

    $posts = "SELECT * FROM posts WHERE user_id = $sid";

    $sql = "SELECT COUNT(requester) as total FROM requests WHERE requestee='$id'";
    $r = mysqli_query($conn,$sql);
    $num = $r->fetch_assoc();
    $req = $num['total'];
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
                        <img src="<?php echo $picture ?>" alt="" class="w3-wide glow" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 100px;width: 100px;object-fit: cover;" onClick="window.location.href ='user.php?id=<?php echo $id ?>'"><br><br>
                        <label style="text-align: center;color: white;"><?php echo "$firstname $lastname"; ?></label><br><br><br>
                </div>
                <div class="w3-padding-64 w3-large w3-text-grey"
                        style="font-weight:bold;height: auto;background-color: black;position: sticky;">
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='home.php'">Home</a>
                        <?php
                            if($id==$sid){
                            ?>
                                <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='user.php?id=<?php echo $id ?>'" style="color: red!important;border-radius: 10px;background-color: #111111!important;">Profile</a>
                            <?php
                            }
                            else{
                            ?>
                                <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='user.php?id=<?php echo $id ?>'">Profile</a>
                            <?php
                            }
                        ?>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='requests.php'">Friend Requests<span class="w3-badge w3-medium" style="background-color: red;margin-left: 10px;border-radius: 20px;font-size: 8px;"><?php echo $req ?></span></a>
                        <a href="#" class="sidebar-item sidebar-button label" style="margin-bottom: 38px;"onClick="window.location.href ='friends.php'">Friends</a>
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
                                        <input type="text" disabled id="search" name="search" placeholder="Search"
                                                style="width: 700px;padding: 5px;">
                                        <button type="button" class="fa fa-search" id="edit" name="edit" style="width: auto;border-radius: 20px" onclick="window.location.href ='search.php'"> <label style="color: white;font-size: 17px">Advanced Search</label></button>
                                </div>
                </div>

                <div style="padding: 20px;padding-left: 50px;margin-left: -150px">
                    <div align="center">
                        <img src="IMG/<?php echo $sprofile_picture ?>" alt='' class="w3-wide glow" style = "border-radius: 200px;object-fit: cover;margin-top: 20px;width: 400px;height: 400px"><br><br>
                        <?php
                        if($id!=$sid){ 
                            $sql = "SELECT * FROM requests";
                            $result = $conn->query($sql);
                            $inRequests = 0;
                            $inFriends = 0;
                            while ($row = $result->fetch_assoc()) {
                                if($row['requester']==$id && $row['requestee']==$sid){
                                    $inRequests = 1;    // ana ely ba3etlo
                                    break;
                                }
                                elseif ($row['requester']==$sid && $row['requestee']==$id) {
                                    $inRequests = 2;    // hwa ely ba3etly
                                    break;
                                }
                            }
                            $sql = "SELECT * FROM friends WHERE user1='$id'";
                            $result = $conn->query($sql);
                            while ($row = $result->fetch_assoc()) {
                                if($row['user1']==$id && $row['user2']==$sid || $row['requester']==$sid && $row['requestee']==$id){
                                    $inFriends = 1;    // ana ely ba3etlo
                                    break;
                                }
                            }
                            if($inRequests==0 && $inFriends==0){
                            ?>
                                <button type="button" id="add" name="add" class="w3-button w3-theme" onclick="window.location.href ='addFriend.php?id=<?php echo $sid ?>'" style="width: 120px;background-color: #00cc00"><i class="fa fa-thumbs-up"></i> Add</button>
                            <?php
                            }
                            elseif($inRequests==1 && $inFriends==0){
                            ?>
                                <button type="button" id="cancel" name="cancel" class="w3-button w3-theme" onclick="window.location.href ='cancel.php?id=<?php echo $sid ?>'" style="width: 120px;background-color: #cc0000"><i class="fa fa-thumbs-up"></i> Cancel</button>
                            <?php
                            }elseif ($inRequests==2 && $inFriends==0) {
                                ?>
                                <button type="button" id="accept" name="accept" class="w3-button w3-theme" onclick="window.location.href ='accept.php?id=<?php echo $sid ?>'" style="width: auto;background-color: #00cc00"><i class="fa fa-check"></i> Accept</button>
                                <button type="button" id="reject" name="reject" class="w3-button w3-theme" onclick="window.location.href ='reject.php?id=<?php echo $sid ?>'" style="width: auto;background-color: #cc0000"><i class="fa fa-close"></i> Reject</button>
                                <?php
                            }
                            elseif ($inRequests==0 && $inFriends==1) {
                                ?>
                                <button type="button" id="unfriend" name="unfriend" class="w3-button w3-theme" onclick="window.location.href ='unfriend.php?id=<?php echo $sid ?>'" style="width: auto;background-color: #cc0000"><i class="fa fa-close"></i> Unfriend</button>
                                <?php
                            }
                        }
                        ?>
                    </div>
                    <form action="profile.php" method="post" style="margin-left: 400px">
                        <label for="firstname">First Name :</label><input type="text" id="firstname" name="firstname" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="First Name" value="<?php echo $sfirstname ?>">
                        
                        <label for="lastname" >Last Name :</label><input type="text" id="lastname" name="lastname" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="Last Name" value="<?php global $lastname;echo $slastname ?>"><br>
                        <label for="email" >E-mail :</label><input type="text" id="email" name="email" style="width: 300px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="example@example.com" value="<?php global $email;echo $semail ?>">
                        <label id="used_email_msg" style="color: red;font-size: 12px;" hidden>*E-mail is already used</label><br>

                        <label for="phone" >Phone Number :</label><input type="text" id="phone" name="phone" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled value="<?php 
                                                                                global $inFriends;
                                                                                if($inFriends==1 || $id==$sid || empty($sphone)){
                                                                                    echo $sphone;
                                                                                }else
                                                                                    echo "Un available";
                                                                                ?>"><br>
                        <label id="birthdate">Birthdate :</label>
                        <input type="text" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="Home Town" value="<?php echo "$sbirthdate"; ?>"><br>
                        
                        <label for="gender">Gender :</label>
                        <input type="text" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="Home Town" value="<?php echo "$sgender"; ?>"><br>
                        <label for="hometown">Hometown :</label></label>
                        <input type="text" id="hometown" name="hometown" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled value="<?php echo $shometown ?>"><br>
                        <br>
                        <label for="status">Marital Status :</label>
                        <input type="text" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled  value="<?php echo $sstatus ?>"><br>
                        <label for="bio" >Bio :</label><br>
                        <textarea id="bio" rows="4" name="bio" class="textarea" disabled><?php 
                                                                                global $inFriends;
                                                                                if($inFriends==1 || $id==$sid || empty($sbio)){
                                                                                    echo $sbio;
                                                                                }else
                                                                                    echo "Un available";
                                                                                ?></textarea>
                        <?php
                        if($id==$sid){ ?>
                            <br><button type="button" class="" id="edit" name="edit" style="width: auto;height: 40px;padding: 0 20px 0 20px;margin-top: 10px;border-radius: 20px;font-family: cursive;" onClick="window.location.href ='profile.php'"><i class="fa fa-edit"></i> Edit</button>
                        <?php
                        }
                        ?>
                        <hr style="border-color: black;max-width: 800px">
                    </form>
                    <div align="center">
                        <?php
                            $sql = "SELECT * FROM posts WHERE user_id = '$sid' ORDER BY date_time DESC";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                ?> <br><label style="font-size: 50px">Posts</label><br><br> <?php
                                while($row = $result->fetch_assoc()) {?>
                                    <div class="" style="padding: 20px; width:700px">
                                        <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                                          <div class="w3-container w3-padding">
                                            <img src="<?php echo "IMG/".$srow['profile_picture'] ?>"  style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 60px;width: 60px;object-fit: cover;">
                                            <label><?php echo $srow['firstname']." ".$srow['lastname']; ?></label><br>
                                            <label style="font-size: 12px;margin-left: 400px"><?php echo $row['date_time'] ?></label>
                                            <text id="caption" rows="4" name="bio" class="textarea" placeholder="Type here" style="width: 600px;"><?php echo $row['caption']; ?><br><br><img alt="" src="<?php echo "IMG/".$row['image'] ?>"  style="box-shadow: 0 0 10px;max-width: 500px;max-height: 200px;object-fit: contain;"></text>
                                            <button type="button" class="w3-button w3-theme" style="width: 120px"><i class="fa fa-thumbs-up"></i> Like</button> 
                                          </div>
                                        </div>
                                    </div>
                                <?php }
                            } else {?>
                                <label>No User Found</label>
                            <?php }
                        
                        ?>


                    </div>
                </div>
        </div>
    <script>
                // Accordion 
                function myAccFunc() {
                        var x = document.getElementById("demoAcc");
                        if (x.className.indexOf("w3-show") == -1) {
                                x.className += " w3-show";
                        } else {
                                x.className = x.className.replace(" w3-show", "");
                        }
                }

                // Click on the "Jeans" link on page load to open the accordion for demo purposes
                document.getElementById("myBtn").click();


                // Open and close sidebar
                function Edit() {
                        document.getElementById("edit").disabled = true;
                        document.getElementById("save").disabled = false;
                        document.getElementById("firstname").disabled = false;
                        document.getElementById("lastname").disabled = false;
                        document.getElementById("email").disabled = false;
                        document.getElementById("phone").disabled = false;
                        document.getElementById("gender").disabled = false;
                        document.getElementById("day").disabled = false;
                        document.getElementById("month").disabled = false;
                        document.getElementById("year").disabled = false;
                        document.getElementById("hometown").disabled = false;
                        document.getElementById("status").disabled = false;
                        document.getElementById("bio").disabled = false;
                }
                
                function Save() {
                        document.getElementById("edit").disabled = false;
                        document.getElementById("save").disabled = true;
                        document.getElementById("firstname").disabled = true;
                        document.getElementById("lastname").disabled = true;
                        document.getElementById("email").disabled = true;
                        document.getElementById("phone").disabled = true;
                        document.getElementById("gender").disabled = true;
                        document.getElementById("day").disabled = true;
                        document.getElementById("month").disabled = true;
                        document.getElementById("year").disabled = true;
                        document.getElementById("hometown").disabled = true;
                        document.getElementById("status").disabled = true;
                        document.getElementById("bio").disabled = true;
                        document.getElementById("pass").hidden = true;
                        document.getElementById("link").hidden = false;
                }
                function changePassword(){
                        document.getElementById("pass").hidden = false;
                        document.getElementById("save").disabled = false;
                        document.getElementById("link").hidden = true;
                }
                function selected(){
                        document.getElementById("change").disabled = false;
                        document.getElementById("remove").disabled = false;
                }
                function add(){
                        document.getElementById("add").disabled = true;
                        document.getElementById("cancel").disabled = false;
                }
                function Cancel(){
                        document.getElementById("add").disabled = false;
                        document.getElementById("cancel").disabled = true;
                }
                </script>
</body>

</html>