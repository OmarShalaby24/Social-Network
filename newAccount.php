<?php
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $database = 'database';

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);
        // Check connection
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
        //echo "connected to database";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $ip_firstName = htmlspecialchars($_REQUEST['firstName']);
                $ip_lastName = htmlspecialchars($_REQUEST['lastName']);
                $ip_password = htmlspecialchars($_REQUEST['password']);
                $ip_confirmpassword = htmlspecialchars($_REQUEST['confirm']);
                $ip_email = htmlspecialchars($_REQUEST['email']);
                $ip_day = htmlspecialchars($_POST['day']);
                $ip_month = htmlspecialchars($_REQUEST['month']);
                $ip_year = htmlspecialchars($_REQUEST['year']);
                $ip_date = "$ip_year-$ip_month-$ip_day";
                $fnameErr = $lnameErr = $passwordErr = $confirmErr = $emialErr = $dayErr = $monthErr = $yearErr = $genderErr = 'error';
                if(!isset($_POST['gender']))
                {
                    //echo"please insert Gender"."<br \>";
                    $genderErr = "*Select Gender";
                    $Error = 1;
                }
                else
                {
                    $ip_gender = $_POST['gender'];
                    $genderErr = '';
                }
            
                //$ip_gender = $_POST['gender'];  // Storing Selected Value In Variable
                //echo "You have selected :---------------------------" .$selected_val;  // Displaying Selected Value
                $sql = "SELECT email FROM user_data WHERE email = '$ip_email'";
                //echo "$sql";
                $result = $conn->query($sql);
                $row_num = $result->num_rows;
                
                if($row_num != 0){
                $emialErr = "*E-mail is already used";
                $Error = 1;
                }else $Error=0;
                if (empty($_REQUEST['firstName'])) {
                        $fnameErr = "*Please enter First Name";
                        $Error = 1;
                }else $fnameErr='';
                if (empty($_REQUEST['lastName'])) {
                        $lnameErr = "*Please enter Last Name";
                        $Error = 1;
                }else $lnameErr='';
                if (empty($_REQUEST['password'])) {
                        $passwordErr = "*Please enter Password";
                        $Error = 1;
                }else $passwordErr='';
                if (empty($_REQUEST['confirm'])) {
                        $confirmErr = "*Please Confirm Password";
                }else $confirmErr='';
                if ($_REQUEST['password']!=$_REQUEST['confirm']) {
                        $confirmErr = "*Password is not the Same";
                        $Error = 1;
                }else $confirmErr='';
                if (empty($_REQUEST['email'])) {
                        $emialErr = "*Please enter E-mail";
                        $Error = 1;
                }
                else
                {
                    $sql = "SELECT email FROM user_data WHERE email = '$ip_email'";
                    $table = $conn->query($sql);
                    $row = $table->fetch_assoc();
                    $noRow = $table->num_rows;
                    if($noRow!=0){
                        $emialErr = '*Email is unavailable';
                        echo $row['email'];
                    }
                    else{
                        $emialErr='';
                    }
                }
                if (empty($_POST['day'])) {
                        $dayErr = "*Select Day";
                        $Error = 1;
                }else $dayErr='';
                if (empty($_REQUEST['month'])||$_REQUEST['month']=='disable') {
                        $monthErr = "*Select Month";
                        $Error = 1;
                }else $monthErr='';
                if (empty($_REQUEST['year'])||$_REQUEST['year']=='disable') {
                        $yearErr = "*Select Year";
                        $Error = 1;
                }else $yearErr='';
                /*if (empty($_POST['gender']) || $_POST['gender']=='') {
                        $genderErr = "*Select Gender";
                        $Error = 1;
                }else $genderErr='';*/
                
                if($ip_gender == 'Male'){
                    $picture = 'male.png';
                }
                elseif ($ip_gender == 'Female') {
                    $picture = 'female.png';
                }
                        
                if($fnameErr=='' && $lnameErr=='' && $emialErr=='' && $passwordErr=='' && $confirmErr=='' && $dayErr=='' && $monthErr=='' && $yearErr=='' && $genderErr==''){
                        echo "hoba";
                        echo "no of Errors = $Error"."<br>";
                        
                        $sql = "INSERT INTO user_data(firstname,lastname,email,password,birthdate,gender,profile_picture) VALUES('$ip_firstName','$ip_lastName','$ip_email','$ip_password','$ip_date','$ip_gender','$picture')";
                        echo $sql."<br>";
                        $row = $conn->query($sql);
                        if(!empty($row))
                        {
                            echo "hi";
                            
                            $sql = "SELECT id FROM user_data WHERE email='$ip_email'";
                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            $id = $row['id'];
                            echo "$id"."<br>";
                            $sql = "INSERT INTO friends(user1, user2) VALUES ('$id','$id')";
                            $result = $conn->query($sql);
                            echo "$sql";
                            //echo "New record has been added successfully !";
                            header("Location:AccDone.php");
                        }
                }
        }
?>



<!DOCTYPE html>
<html>
        <head>
                <title>Create Account</title>
                <meta charset="utf-8">
                <link rel="stylesheet" href="style.css">
        </head>
        <body style="background-color: #dddddd;">
                <header class="rectangle">
                        <div align="center"><img src="img/Logo.png" alt="logo" class="logo glow" border="2px" height="150px"></div>
                </header>
                <div align="center">
                        <form action="#" method="POST" class="rectangle" style="margin-top: 150px; width: 400px;height:auto ;padding: 20px;background-color: white;">
                                <!--<?php echo htmlspecialchars("CreateAcc.php");?>-->
                                <label for="firstName">First Name</label>
                                <input type="text" name="firstName" id="firstName" placeholder="First Name">
                                <label style="color: red;font-size: 12px;"><?php global $fnameErr;echo $fnameErr ?></label><br>

                                <label for="lastName">Last Name</label>
                                <input type="text" name="lastName" id="lastName" placeholder="Last Name">
                                <label style="color: red;font-size: 12px;"><?php global $lnameErr;echo $lnameErr ?></label><br>

                                <label for="email">E-mail</label>
                                <input type="text" name="email" id="email" placeholder="E-mail">
                                <label style="color: red;font-size: 12px;"><?php global $emialErr;echo $emialErr ?></label><br>

                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="Password">
                                <label style="color: red;font-size: 12px;"><?php global $passwordErr;echo $passwordErr ?></label><br>

                                <label for="confirm">Confirm Password</label>
                                <input type="password" name="confirm" id="confirm" placeholder="Confirm Password">
                                <label style="color: red;font-size: 12px;"><?php global $confirmErr;echo $confirmErr ?></label>
                                <br>
                                <label for="birthdate">Birthdate</label><br>
                                <select id="day" name="day">
                                        <option value='' selected hidden>Day</option>
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
                                <select id="month" name="month">
                                        <option value='' selected hidden>Month</option>
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
                                <select id="year" name="year">
                                        <option value='' selected hidden>Year</option>
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
                                </select><br>
                                <label style="color: red;font-size: 12px;"><?php global $dayErr;echo $dayErr ?></label>
                                <label style="color: red;font-size: 12px;"><?php global $monthErr;echo $monthErr ?></label>
                                <label style="color: red;font-size: 12px;"><?php global $yearErr;echo $yearErr ?></label>
                                <br>
                                <label >Gender</label><br>
                                <input type="radio" id="male" name="gender" value="Male">
                                <label for="male">Male</label>
                                <br>
                                <input type="radio" id="female" name="gender" value="Female">
                                <label for="female">Female</label>
                                <br>
                                <label style="color: red;font-size: 12px;"><?php global $genderErr;echo $genderErr ?></label>

                                <button id="create" name="create" onclick="window.location.href ='AccDone.html';">Create Account</button>
		        </form>
                </div>
        </body>
</html>