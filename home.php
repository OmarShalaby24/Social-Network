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
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $picture = "img/".$row['profile_picture'];
        //echo "----------------------------------------------------------------------- $picture";

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
        <link rel="stylesheet" href="style2.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet"href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>


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
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='home.php'" style="color: red!important;border-radius: 10px;background-color: #111111!important;">Home</a>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='user.php?id=<?php echo $id ?>'">Profile</a>
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
                                        <input type="text" id="search" name="search" placeholder="Search"
                                                style="width: 700px;padding: 5px;">
                                        <button type="button" class="fa fa-search" id="edit" name="edit" style="width: auto;border-radius: 20px" onclick="window.location.href ='search.php'"> <label style="color: white;font-size: 17px">Advanced Search</label></button>
                                </div>
                </div>
                <!-- !Timeline ! -->


                <div align="center" style="margin-left: -500px">
                        <div class="" style="padding: 20px; width:700px">
                            <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px">
                              <div class="w3-container w3-padding">
                                <form method="POST" action="post.php" enctype="multipart/form-data">
                                    <label class="w3-opacity" style="font-size: 17px">What's in your mind?</label>
                                    <select id="isPublic" name="isPublic" style="font-weight: bold;font-family: cursive;font-size: 12px;height: 25px;width: 80px;padding: 1px;margin-left: 500px;margin-top: -500px">
                                        <option value=1 selected >Public</option>
                                        <option value=0 >Private</option>
                                    </select>
                                    <textarea id="caption" name="caption" rows="4" name="bio" class="textarea" placeholder="Type here" style="width: 600px" ></textarea>
                                    <img id="blah" name="picture" alt="" src="#" border="20px" style="object-fit: contain;max-height: 200px;max-width: 500px;box-shadow: 0 0 10px" /><br><br>
                                    <button type="submit" id="post" name="post" class="w3-button label" style="width: 120px"><i class="fa fa-pencil"></i> Post</button> 
                                    <label id="select" for="imageUpload" class=" w3-button pic"><i class="fa fa-camera"></i> Upload</label>
                                    <input type="file" id="imageUpload" name="imageUpload" accept="image/*" style="display: none" onchange="readURL(this);">
                                </form>
                              </div>
                            </div>
                        </div>
                        <?php
                            $sql = "SELECT user_data.id,user_data.firstname,user_data.lastname,user_data.profile_picture,posts.*,friends.* FROM ((posts INNER JOIN user_data ON posts.user_id = user_data.id)INNER JOIN friends ON posts.user_id=friends.user2) WHERE friends.user1='$id' ORDER BY posts.date_time DESC";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {?>
                                    <div class="" style="padding: 20px; width:700px">
                                        <div class="w3-card w3-round w3-white"style="border-radius:20px;box-shadow: 0 5px 10px" align="left">
                                          <div class="w3-container w3-padding">
                                            <img src="<?php echo "IMG/".$row['profile_picture'] ?>"  style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px;height: 60px;width: 60px;object-fit: cover;">
                                            <label><?php echo $row['firstname']." ".$row['lastname']; ?></label>
                                            <label style="font-size: 12px;margin-left: 400px;"><?php echo $row['date_time'] ?></label>
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
</body>
<script type="text/javascript">
         function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah')
                        .attr('src', e.target.result)
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
</script>

</html>