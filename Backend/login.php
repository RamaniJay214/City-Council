<?php
session_name('otp');
session_start();



require 'C:\PHPMailer-master\src\Exception.php';
require 'C:\PHPMailer-master\src\PHPMailer.php';
require 'C:\PHPMailer-master\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


$servername = "localhost";  // Replace with your server name or IP address
$username = "root";         // Replace with your database username
$password = "jay@6125";             // Replace with your database password
$dbname = "city_council";  // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Create an instance of PHPMailer
$mail = new PHPMailer(true);


// Email and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];

$otp = rand(100000, 999999);  // Generate a random 6-digit OTP
$_SESSION['OTP'] = $otp;      // Store the OTP in session for later verification
$_SESSION['email'] = $email;  // Store email in session

// Function to send OTP using PHPMailer
function sendOTP($email, $otp) {
    $mail = new PHPMailer(true); 

    try {
        // Server settings
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = 'citycouncil.official@gmail.com';           // Your Gmail address
        $mail->Password = 'nmnr ayiv hqha mhve';              // Gmail App Password or your email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
        $mail->Port = 587;                                  // TCP port to connect to
    
        // Recipient
        $mail->setFrom('citycouncil.official@gmail.com', 'City Council');
        $mail->addAddress($email);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Your one time password OTP for login is';
        $mail->Body    = 'Your OTP code is: ' . $otp;
        $mail->Subject = 'Please do not share this OTP to any one';

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

// Function to check login details in the specified table
function checkLogin($email, $password, $table) {
    global $conn;

    $query = "SELECT * FROM $table WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        return true;
    }
    return false;
}



// Check login details in the 'admin' table
if (checkLogin($email, $password, 'customer')) {
    $_SESSION['dashboard'] = 'registration.php';  // Store the correct dashboard path in session
    if (sendOTP($email, $otp)) {
        header("Location: otp_page.php");
    } else {
        echo "Failed to send OTP.";
    }
    exit();
}

// Check login details in the 'customer' table
if (checkLogin($email, $password, 'customer')) {
    $_SESSION['dashboard'] = 'registration.php';  // Store the correct dashboard path in session
    if (sendOTP($email, $otp)) {
        header("Location: otp_page.php");
    } else {
        echo "Failed to send OTP.";
    }
    exit();
}

// Check login details in the 'employee' table
if (checkLogin($email, $password, 'customer')) {
    $_SESSION['dashboard'] = 'registration.php';  // Store the correct dashboard path in session
    if (sendOTP($email, $otp)) {
        header("Location: otp_page.php");
    } else {
        echo "Failed to send OTP.";
    }
    exit();
}

// If email and password don't match any table
echo "Invalid email or password.";
exit();
?>
