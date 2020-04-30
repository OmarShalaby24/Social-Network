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
                $ip_day = htmlspecialchars($_REQUEST['day']);
                $ip_month = htmlspecialchars($_REQUEST['month']);
                $ip_year = htmlspecialchars($_REQUEST['year']);
                $ip_date = "$ip_year-$ip_month-$ip_day";
                $ip_gender = $_POST['gender'];  // Storing Selected Value In Variable
                //echo "You have selected :---------------------------" .$selected_val;  // Displaying Selected Value
                if (empty($_REQUEST['firstName'])) {
                    $fnameErr = "*Please enter First Name";
                }
                if (empty($_REQUEST['lastName'])) {
                    $lnameErr = "*Please enter Last Name";
                }
                if (empty($_REQUEST['password'])) {
                    $passwordErr = "*Please enter Password";
                }
                if (empty($_REQUEST['confirm'])) {
                    $confirmErr = "*Please Confirm Password";
                }
                if (empty($_REQUEST['email'])) {
                    $emialErr = "*Please enter E-mail";
                }
                if (empty($_REQUEST['day'])) {
                    $dayErr = "*Select Day";
                }
                if (empty($_REQUEST['month'])) {
                    $monthErr = "*Select Month";
                }
                if (empty($_REQUEST['year'])) {
                    $yearErr = "*Select Year";
                }
                if (empty($_REQUEST['gender'])) {
                    $genderErr = "*Select Gender";
                }

                if($ip_firstName == ''){
                        echo"please insert your First Name"."<br \>";
                }      
                elseif($ip_lastName == ''){
                        echo"please insert your Last Name"."<br \>";
                }
                elseif($ip_email==''){
                    echo"please insert your Email"."<br \>";
                }
                
                elseif($ip_password == ''){
                        echo"please insert your password"."<br \>";
                }

         
                elseif($ip_confirmpassword == ''){
                        echo"please insert your confirm password"."<br \>";
                }
                elseif($ip_password != $ip_confirmpassword){
                    echo"please insert your confirm password Correctly"."<br \>";
                }
                         
                
                elseif(!isset($_POST['gender']))
                {
                    
                    echo"please insert Gender"."<br \>";
                }
                elseif($ip_day == ''||$ip_month == ''||$ip_year == ''){
                                echo"please enter a valid date"."<br \>";
                        }
                else{
                        $result = "INSERT INTO user_data(firstname,lastname,email,password,birthdate,gender) VALUES('$ip_firstName','$ip_lastName','$ip_email','$ip_password','$ip_date','$ip_gender')";    
                        echo $result."<br>";
                        echo $ip_gender."<br>";

                        if (mysqli_query($conn, $result)) {
                        echo "New record has been added successfully !";
                        } 
                        else {
                                echo "Error: " . $result . ":-" . mysqli_error($conn);
                        }
                        header("Location:AccDone.php");
                }
        }
        else{
                echo"404_error"."<br \>";
        }
        
        
?>