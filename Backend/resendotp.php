<?php
session_name('otp');
session_start();

require 'C:\PHPMailer-master\src\Exception.php';
require 'C:\PHPMailer-master\src\PHPMailer.php';
require 'C:\PHPMailer-master\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
$email=$_SESSION['email'];
function sendOTP($email, $otp) {
    $mail = new PHPMailer(true); 

    try {
        // Server settings
        $mail->isSMTP();                                    // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                             // Enable SMTP authentication
        $mail->Username = 'citycouncil.official@gmail.com';           // Your Gmail address
        $mail->Password = 'uqlf wdhv tuxh fobk';              // Gmail App Password or your email password
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
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resend_otp'])) {
    $otp = rand(100000, 999999);  // Generate a new OTP
    $_SESSION['OTP'] = $otp;      // Update OTP in session

    // Resend the OTP to the user's email
    if (sendOTP($email, $otp)) {
        echo "A new OTP has been sent to your email.";
    } else {
        echo "Failed to send OTP.";
    }
}
?>