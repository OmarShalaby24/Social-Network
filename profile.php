<?php
        session_start();
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
        $sql = "SELECT * FROM user_data WHERE email = '$email'";
        //echo "$sql";

        $result = $conn->query($sql);
        $row_num = $result->num_rows;
        $row = $result->fetch_assoc();

        $id = $row['id'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];

        $birthdate = explode('-', $row['birthdate']);
        $profile_picture = $row['profile_picture'];
        $hometown = $row['hometown'];
        $marital_status = $row['marital_status'];
        $about_me = $row['about_me'];
        $gender = $row['gender'];
        $phone = $row['phone'];
        switch ($birthdate[1]) {
                case '1':
                        $month = 'January';
                        break;
                case '2':
                        $month = 'February';
                        break;
                case '3':
                        $month = 'March';
                        break;
                case '4':
                        $month = 'April';
                        break;
                case '5':
                        $month = 'May';
                        break;
                case '6':
                        $month = 'June';
                        break;
                case '7':
                        $month = 'July';
                        break;
                case '8':
                        $month = 'August';
                        break;
                case '9':
                        $month = 'Septemper';
                        break;
                case '10':
                        $month = 'October';
                        break;
                case '11':
                        $month = 'November';
                        break;
                case '12':
                        $month = 'December';
                        break;
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
                        <img src="img/male.png" alt="" class="w3-wide glow" height="100px" style="border-radius: 200px;box-shadow: 0 0 10px white;margin-top: 20px" onClick="window.location.href ='profile.html'"><br><br>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href =''">Change Profile Pictuer</a>
                </div>
                <div class="w3-padding-64 w3-large w3-text-grey"
                        style="font-weight:bold;height: auto;background-color: black;position: sticky;margin-top: -16px">
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='home.php'">Home</a>
                        <a href="#" class="sidebar-item sidebar-button label" onClick="window.location.href ='profile.php'" style="color: red!important;border-radius: 10px;background-color: #111111!important;">Profile</a>
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
                                        <input type="text" disabled id="search" name="search" placeholder="Search"
                                                style="width: 700px;padding: 5px;">
                                        </div>
                </div>

                <div align="center">
                        <form align="left" style="padding: 20px;padding-left: 50px">
                                <label for="firstname">First Name :</label><input type="text" id="firstname" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="First Name" value="<?php global $firstname;echo $firstname ?>">
                                <label for="lastname" >Last Name :</label><input type="text" id="lastname" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="Last Name" value="<?php global $lastname;echo $lastname ?>"><br><br>
                                <label for="email" >E-mail :</label><input type="text" id="email" style="width: 300px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="example@example.com" value="<?php global $email;echo $email ?>">
                                <label id="used_email_msg" style="color: red;font-size: 12px;" hidden>*E-mail is already used</label><br><br>
                                <label >Password :</label>
                                <a href="#" id="link" style="color: red;" onclick="changePassword()">Change</a>
                                <div id="pass" hidden style="margin-left: 130px;margin-top: -62px;">
                                        <br>
                                        <input type="password" id="newpass" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" placeholder="New Password">
                                        <input type="password" id="cnfpass" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" placeholder="Confirm Password">
                                </div>
                                <br><hr>
                                <label for="phone" >Phone Number :</label><input type="text" id="phone" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="01** *** ****" value="<?php global $phone;echo $phone ?>"><br><br>
                                <label id="Birthdate">Birthdate :</label>
                                <select id="day" name="day" disabled>
                                        <option value=disable selected hidden><?php global $birthdate;echo "$birthdate[2]"; ?></option>
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
                                        <option value=disable selected hidden><?php global $month;echo "$month"; ?></option>
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
                                        <option value=disable selected hidden><?php global $birthdate;echo "$birthdate[0]"; ?></option>
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
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                </select>
                                <br><br>
                                <label for="hometown">Hometown :</label></label>
                                <input type="text" id="hometown" style="width: 200px;height: 40px;margin-left: 10px;text-align: left;" disabled placeholder="Home Town" value="<?php global $hometown;echo $hometown ?>"><br>
                                <br>
                                <label for="status">Marital Status :</label>
                                <select name="status" id="status" disabled>
                                        <?php
                                        global $marital_status;
                                        if($marital_status=='S'){
                                                ?><option value="S" selected hidden >Single</option><?php
                                        }
                                        elseif($marital_status=='M'){
                                                ?><option value='M' selected hidden >Married</option><?php
                                        }
                                        elseif($marital_status=='E'){
                                                ?><option value='E' selected hidden >Engaged</option><?php
                                        }
                                        else
                                                ?><option value=disabled selected hidden >Not Selected</option><?php
                                        ?>
                                        <option value="S">Single</option>
                                        <option value="E">Engaged</option>
                                        <option value="M">Married</option>
                                </select>
                                <br><br>
                                <label for="bio" >About me :</label><br>
                                <textarea id="bio" rows="4" name="bio" class="textarea" placeholder="Your bio..." disabled></textarea>
                                <br>
                                <button type="button" class="fa fa-pencil" id="edit" name="edit" style="width: auto;border-radius: 20px" onclick="Edit()"> <label style="color: white;font-size: 17px">Edit</label></button>
                                <button type="submit" class="fa fa-save" id="save" disabled name="save" style="width: auto;border-radius: 20px" onclick="Save()"> <label style="color: white;font-size: 17px">Save</label></button>
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
                </script>
</body>

</html>