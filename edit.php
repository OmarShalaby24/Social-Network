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
                        //header("Location:AccDone.php");
                    }
                    else {
                            //echo "Error: " . $result . ":-" . mysqli_error($conn);
                            $emialErr = '*Email is unavailable';
                    }
                    
            }
        
        
        //echo "$ip_firstname";
        //echo "$ip_firstname-$ip_lastname-$ip_email-$ip_password-$ip_confirmpassword-$ip_date";
                
        }
    header("Location:user.php?id=<?php echo $id?>&name=<?php echo $firstname.' '.$lastname ?>")

?>