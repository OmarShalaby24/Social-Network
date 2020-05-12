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
    $_SESSION['gender'] = $gender;
    $phone = $row['phone'];
    $picture = "img/".$row['profile_picture'];
        
    switch ($month) {
            case '1':
                    $S_month = 'January';
            break;
            case '2':
                    $S_month = 'February';
                    break;
            case '3':
                    $S_month = 'March';
                    break;
            case '4':
                    $S_month = 'April';
                    break;
            case '5':
                    $S_month = 'May';
                    break;
            case '6':
                    $S_month = 'June';
                    break;
            case '7':
                    $S_month = 'July';
                    break;
            case '8':
                    $S_month = 'August';
                    break;
            case '9':
                    $S_month = 'Septemper';
                    break;
            case '10':
                    $S_month = 'October';
                    break;
            case '11':
                    $S_month = 'November';
                    break;
            case '12':
                    $S_month = 'December';
                    break;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
    //take values from the form as it is submited
        $ip_firstname = htmlspecialchars($_REQUEST['firstname']);
        $ip_lastname = htmlspecialchars($_REQUEST['lastname']);
        $ip_password = htmlspecialchars($_REQUEST['password']);
        $ip_confirmpassword = htmlspecialchars($_REQUEST['confirm']);
        $ip_email = htmlspecialchars($_REQUEST['email']);
        $ip_phone = htmlspecialchars($_REQUEST['phone']);
        //read date form the Form
        $ip_day = htmlspecialchars($_REQUEST['day']);
        $ip_month = htmlspecialchars($_REQUEST['month']);
        $ip_year = htmlspecialchars($_REQUEST['year']);
        //echo "Month From the Form : $ip_month"."<br>";
        $ip_date = "$ip_year-$ip_month-$ip_day";
        $ip_gender = htmlspecialchars($_REQUEST['gender']);
        $ip_hometown = htmlspecialchars($_REQUEST['hometown']);
        $ip_status = htmlspecialchars($_REQUEST['status']);
        $ip_bio = htmlspecialchars($_REQUEST['bio']);
        /*    
        echo $ip_firstname."<br>";
        echo $ip_lastname."<br>";
        echo $ip_password."<br>";
        echo $ip_confirmpassword."<br>";
        echo $ip_email."<br>";
        echo $ip_phone."<br>";
        echo $ip_day."<br>";
        echo $ip_month."<br>";
        echo $ip_year."<br>";
        echo $ip_gender."<br>";
        echo $ip_hometown."<br>";
        echo $ip_status."<br>";
        echo $ip_bio."<br>"."<br>"."<br>";
        */
        $fnameErr = $lnameErr = $passwordErr = $confirmErr = $emailErr = $dayErr = $monthErr = $yearErr = $genderErr = 'error';

        //check email
    if($ip_email == $email){
    }
    elseif($ip_email==''){
            $emailErr = "E-mail is required";
    }
    elseif($ip_email!=$email){
            $sql = "SELECT email FROM user_data WHERE email = '$ip_email'";
            $result = $conn->query($sql);
            $rowsNum = $result->num_rows;
            if($rowsNum==0){
                    $email = $ip_email;
            }
            else{
                    $emailErr = "Email is not available";
                    $Error = 1;
            }
    }

    //check firstname and lastname
    if($ip_firstname!=''){
            $firstname = $ip_firstname;
    }
    if($ip_lastname!=''){
            $lastname = $ip_lastname;
    }

    //check phone number
    if($ip_phone!='')
            $phone = $ip_phone;


    //check password
    //echo "Password in database : $password"."<br>";
    if (!empty($_REQUEST['password']) && !empty($_REQUEST['confirm']) && $_REQUEST['confirm']==$_REQUEST['password'] ) {
            $password = $ip_password;
            $passwordErr = '';
    }
    elseif(empty($_REQUEST['password']) || empty($_REQUEST['confirm']) || $_REQUEST['confirm']!=$_REQUEST['password'] ){
            $passwordErr = '*Check your input';
            $Error = 1;
    }

    //check birthdate
    if (empty($_POST['day'])||$_REQUEST['day']=='disable') {
            $dayErr = "*Select Day";
            $Error = 1;
    }
    else
    {
            $day = $ip_day;
            $dayErr='';
    }
    if (empty($_REQUEST['month'])||$_REQUEST['month']=='disable') {
            $monthErr = "*Select Month";
            $Error = 1;
    }
    else
    {
            $month = $ip_month;
            $monthErr='';       
    }
    if (empty($_REQUEST['year'])||$_REQUEST['year']=='disable') {
            $yearErr = "*Select Year";
            $Error = 1;
    }
    else
    {
            $year = $ip_year;
            $yearErr='';
    }
    switch ($month) {
            case '1':
                    $S_month = 'January';
            break;
            case '2':
                    $S_month = 'February';
                    break;
            case '3':
                    $S_month = 'March';
                    break;
            case '4':
                    $S_month = 'April';
                    break;
            case '5':
                    $S_month = 'May';
                    break;
            case '6':
                    $S_month = 'June';
                    break;
            case '7':
                    $S_month = 'July';
                    break;
            case '8':
                    $S_month = 'August';
                    break;
            case '9':
                    $S_month = 'Septemper';
                    break;
            case '10':
                    $S_month = 'October';
                    break;
            case '11':
                    $S_month = 'November';
                    break;
            case '12':
                    $S_month = 'December';
                    break;
    }

    //check gender
    if(!isset($_POST['gender']))
    {
        echo "$GENDER : $gender";
        //echo"please insert Gender"."<br \>";
        //$genderErr = "*Select Gender";
        //$Error = 1;
    }
    else
    {
        $ip_gender = $_POST['gender'];
        $genderErr = '';
    }

    //check maritial status
    if (empty($_REQUEST['status'])||$_REQUEST['status']=='disable') {
            $statusErr = "*Select Status";
            $Error = 1;
    }
    else{
        $status = $ip_status;
    }
    //check maritial status
    if (empty($_REQUEST['gender'])||$_REQUEST['gender']=='disable') {
            $genderErr = "*Select Gender";
            $Error = 1;
    }
    else{
        $gender = $ip_gender;
    }

    $birthdate = "$year-$ip_month-$day";
    $hometown = $ip_hometown;
    $bio = $ip_bio;

    /*
    echo $firstname."<br>";
    echo $lastname."<br>";
    echo $password."<br>";
    echo $email."<br>";
    echo $phone."<br>";
    echo $day."<br>";
    echo $month."<br>";
    echo $year."<br>";
    echo $gender."<br>";
    echo $hometown."<br>";
    echo $status."<br>";
    echo $bio."<br>";
    */

    if($firstname!='' && $lastname!='' && $email!=''){
                    $sql = "UPDATE user_data SET firstname='$firstname',lastname='$lastname',email='$email',password='$password',birthdate='$ip_date',hometown='$hometown',marital_status='$status',about_me='$bio',gender='$gender',phone='$phone' WHERE id = '$id'";
                    //echo $sql;
                    if (mysqli_query($conn, $sql)) {
                        //echo "New record has been added successfully !";
                        header("Location:user.php?id=$id");

                    }
                    else {
                            //echo "Error: " . $result . ":-" . mysqli_error($conn);
                            $emialErr = '*Email is unavailable';
                    }
                    
            }
        
        
        //echo "$ip_firstname";
        //echo "$ip_firstname-$ip_lastname-$ip_email-$ip_password-$ip_confirmpassword-$ip_date";
                
        }
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
                        <form method="POST" action="pic.php" enctype="multipart/form-data" style="margin-top: -6px"> 

                            <label id="select" for="imageUpload" class="sidebar-item sidebar-button label" onclick="selected()">Select a Picture</label>
                            <input type="file" id="imageUpload" accept="image/*" style="display: none" name="uploadfile" onclick="selected()">
                            <div> 
                                <button type="submit" class="" id="change" name="upload" disabled style="width: auto;height: 40px;padding: 0 20px 0 20px;margin-top: 10px;border-radius: 20px;font-family: cursive;"><i class="fa fa-edit"></i> Change</button>
                                <button type="submit" class="" id="remove" name="remove" style="width: auto;height: 40px;padding: 0 20px 0 20px;margin-top: 10px;border-radius: 20px;font-family: cursive;"><i class="fa fa-remove"></i> Remove</button>

                            </div> 
                        </form> 
                </div>
                <div class="w3-padding-64 w3-large w3-text-grey"
                        style="font-weight:bold;height: auto;background-color: black;position: sticky;margin-top: -16px">
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='home.php'">Home</a>
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
                                        <input type="text" disabled id="search" name="search" placeholder="Search"
                                                style="width: 700px;padding: 5px;">
                                        <button type="button" class="fa fa-search" id="edit" name="edit" style="width: auto;border-radius: 20px" onclick="window.location.href ='search.php'"> <label style="color: white;font-size: 17px">Advanced Search</label></button>
                                </div>
                </div>

                <div align="left">
                        <form action="#" method="POST" align="left" name="form" style="padding: 20px;padding-left: 50px">
                                <label for="firstname">First Name :</label><input type="text" id="firstname" name="firstname" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="First Name" value="<?php global $firstname;echo $firstname ?>">
                                
                                <label for="lastname" >Last Name :</label><input type="text" id="lastname" name="lastname" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="Last Name" value="<?php global $lastname;echo $lastname ?>"><br><br>
                                <label for="email" >E-mail :</label><input type="text" id="email" name="email" style="width: 300px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="example@example.com" value="<?php global $email;echo $email ?>">
                                <label id="used_email_msg" style="color: red;font-size: 12px;" hidden>*E-mail is already used</label><br><br>
                                <label >Password :</label>
                                <a href="#" id="link" style="color: red;" onclick="changePassword()">Change</a>
                                <div id="pass" hidden style="margin-left: 130px;margin-top: -62px;">
                                        <br>
                                        <input type="password" id="password" name="password" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" placeholder="New Password">
                                        <input type="password" id="confirm" name="confirm" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" placeholder="Confirm Password">
                                </div>
                                <br><hr>
                                <label for="phone" >Phone Number :</label><input type="text" id="phone" name="phone" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="01** *** ****" value="<?php global $phone;echo $phone ?>"><br><br>
                                <label id="birthdate">Birthdate :</label>
                                <select id="day" name="day" disabled>
                                        <option value="<?php echo "$day"; ?>" selected hidden><?php echo "$day"; ?></option>
                                        <option value=1>1</option>
                                        <option value=2>2</option>
                                        <option value=3>3</option>
                                        <option value=4>4</option>
                                        <option value=5>5</option>
                                        <option value=6>6</option>
                                        <option value=7>7</option>
                                        <option value=8>8</option>
                                        <option value=9>9</option>
                                        <option value=10>10</option>
                                        <option value=11>11</option>
                                        <option value=12>12</option>
                                        <option value=13>13</option>
                                        <option value=14>14</option>
                                        <option value=15>15</option>
                                        <option value=16>16</option>
                                        <option value=17>17</option>
                                        <option value=18>18</option>
                                        <option value=19>19</option>
                                        <option value=20>20</option>
                                        <option value=21>21</option>
                                        <option value=22>22</option>
                                        <option value=23>23</option>
                                        <option value=24>24</option>
                                        <option value=25>25</option>
                                        <option value=26>26</option>
                                        <option value=27>27</option>
                                        <option value=28>28</option>
                                        <option value=29>29</option>
                                        <option value=30>30</option>
                                        <option value=31>31</option>
                                </select>
                        
                                <select id="month" name="month" disabled>
                                <option value="<?php global $month;echo "$month"; ?>" selected hidden><?php global $S_month; echo "$S_month"; ?></option>
                                        <option value=1>January</option>
                                        <option value=2>February</option>
                                        <option value=3>March</option>
                                        <option value=4>April</option>
                                        <option value=5>May</option>
                                        <option value=6>June</option>
                                        <option value=7>July</option>
                                        <option value=8>August</option>
                                        <option value=9>Septemper</option>
                                        <option value=10>October</option>
                                        <option value=11>November</option>
                                        <option value=12>December</option>

                                </select>
                                <select id="year" name="year" disabled>
                                <option value="<?php echo "$year"; ?>" selected hidden><?php echo "$year"; ?></option>
                                        <option value=2020>2020</option>
                                        <option value=2019>2019</option>
                                        <option value=2018>2018</option>
                                        <option value=2017>2017</option>
                                        <option value=2016>2016</option>
                                        <option value=2015>2015</option>
                                        <option value=2014>2014</option>
                                        <option value=2013>2013</option>
                                        <option value=2012>2012</option>
                                        <option value=2011>2011</option>
                                        <option value=2010>2010</option>
                                        <option value=2009>2009</option>
                                        <option value=2008>2008</option>
                                        <option value=2007>2007</option>
                                        <option value=2006>2006</option>
                                        <option value=2005>2005</option>
                                        <option value=2004>2004</option>
                                        <option value=2003>2003</option>
                                        <option value=2002>2002</option>
                                        <option value=2001>2001</option>
                                        <option value=2000>2000</option>
                                        <option value=1999>1999</option>
                                        <option value=1998>1998</option>
                                        <option value=1997>1997</option>
                                        <option value=1996>1996</option>
                                        <option value=1995>1995</option>
                                        <option value=1994>1994</option>
                                        <option value=1993>1993</option>
                                        <option value=1992>1992</option>
                                        <option value=1991>1991</option>
                                        <option value=1990>1990</option>
                                        <option value=1989>1989</option>
                                        <option value=1988>1988</option>
                                        <option value=1987>1987</option>
                                        <option value=1986>1986</option>
                                        <option value=1985>1985</option>
                                        <option value=1984>1984</option>
                                        <option value=1983>1983</option>
                                        <option value=1982>1982</option>
                                        <option value=1981>1981</option>
                                        <option value=1980>1980</option>
                                        <option value=1979>1979</option>
                                        <option value=1978>1978</option>
                                        <option value=1977>1977</option>
                                        <option value=1976>1976</option>
                                        <option value=1975>1975</option>
                                        <option value=1974>1974</option>
                                        <option value=1973>1973</option>
                                        <option value=1972>1972</option>
                                        <option value=1971>1971</option>
                                        <option value=1970>1970</option>
                                        <option value=1969>1969</option>
                                        <option value=1968>1968</option>
                                        <option value=1967>1967</option>
                                        <option value=1966>1966</option>
                                        <option value=1965>1965</option>
                                        <option value=1964>1964</option>
                                        <option value=1963>1963</option>
                                        <option value=1962>1962</option>
                                        <option value=1961>1961</option>
                                        <option value=1960>1960</option>
                                        <option value=1959>1959</option>
                                        <option value=1958>1958</option>
                                        <option value=1957>1957</option>
                                        <option value=1956>1956</option>
                                        <option value=1955>1955</option>
                                        <option value=1954>1954</option>
                                        <option value=1953>1953</option>
                                        <option value=1952>1952</option>
                                        <option value=1951>1951</option>
                                        <option value=1950>1950</option>
                                        <option value=1949>1949</option>
                                        <option value=1948>1948</option>
                                        <option value=1947>1947</option>
                                        <option value=1946>1946</option>
                                        <option value=1945>1945</option>
                                        <option value=1944>1944</option>
                                        <option value=1943>1943</option>
                                        <option value=1942>1942</option>
                                        <option value=1941>1941</option>
                                        <option value=1940>1940</option>
                                        <option value=1939>1939</option>
                                        <option value=1938>1938</option>
                                        <option value=1937>1937</option>
                                        <option value=1936>1936</option>
                                        <option value=1935>1935</option>
                                        <option value=1934>1934</option>
                                        <option value=1933>1933</option>
                                        <option value=1932>1932</option>
                                        <option value=1931>1931</option>
                                        <option value=1930>1930</option>
                                        <option value=1929>1929</option>
                                        <option value=1928>1928</option>
                                        <option value=1927>1927</option>
                                        <option value=1926>1926</option>
                                        <option value=1925>1925</option>
                                        <option value=1924>1924</option>
                                        <option value=1923>1923</option>
                                        <option value=1922>1922</option>
                                        <option value=1921>1921</option>
                                        <option value=1920>1920</option>
                                        <option value=1919>1919</option>
                                        <option value=1918>1918</option>
                                        <option value=1917>1917</option>
                                        <option value=1916>1916</option>
                                        <option value=1915>1915</option>
                                        <option value=1914>1914</option>
                                        <option value=1913>1913</option>
                                        <option value=1912>1912</option>
                                        <option value=1911>1911</option>
                                        <option value=1910>1910</option>
                                        <option value=1909>1909</option>
                                        <option value=1908>1908</option>
                                        <option value=1907>1907</option>
                                        <option value=1906>1906</option>
                                        <option value=1905>1905</option>
                                        <option value=1904>1904</option>
                                        <option value=1903>1903</option>
                                        <option value=1902>1902</option>
                                        <option value=1901>1901</option>
                                        <option value=1900>1900</option>
                                </select>
                                <br><br>
                                <label for="gender">Gender :</label>
                                <select name="gender" id="gender" disabled>
                                    <option value="<?php echo "$gender"; ?>" selected hidden><?php echo "$gender"; ?></option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                </select>
                                <br><br>
                                <label for="hometown">Hometown :</label></label>
                                <input type="text" id="hometown" name="hometown" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="Home Town" value="<?php global $hometown;echo $hometown ?>"><br>
                                <br>
                                <label for="status">Marital Status :</label>
                                <select name="status" id="status" disabled>
                    <option value='<?php global $status;echo $status; ?>' selected hidden ><?php global $status;echo $status; ?></option>
                                        <option value="Single">Single</option>
                                        <option value="Engaged">Engaged</option>
                                        <option value="Married">Married</option>
                                </select>
                                <br><br>
                                <label for="bio" >About me :</label><br>
                                <textarea id="bio" rows="4" name="bio" class="textarea" placeholder="Your bio..." disabled><?php global $bio;echo $bio ?></textarea>
                                <br>

                                <button type="submit" class="" id="save" disabled name="save" style="width: auto;height: 40px;padding: 0 20px 0 20px;margin-top: 10px;border-radius: 20px;font-family: cursive;" onClick="window.location.href ='profile.php'"><i class="fa fa-save"></i> Save</button>

                                <button type="button" class="" id="edit" name="edit" style="width: auto;height: 40px;padding: 0 20px 0 20px;margin-top: 10px;border-radius: 20px;font-family: cursive;font-size: 14px" onclick="Edit()"><i class="fa fa-edit"></i> Edit</button>
                        </form>
                        
                        
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
                </script>
</body>

</html>