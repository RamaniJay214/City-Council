<?php
// Load PHPMailer classes
require 'C:\PHPMailer-master\src\Exception.php';
require 'C:\PHPMailer-master\src\PHPMailer.php';
require 'C:\PHPMailer-master\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Create an instance of PHPMailer
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                             // Enable SMTP authentication
    $mail->Username = 'jayr43178@gmail.com';          // Your Gmail address
    $mail->Password = 'ouhs cadt zeqh wbub';            // Your Gmail password or App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption
    $mail->Port = 587;                                 // TCP port to connect to

    // Recipients
    $mail->setFrom('jayr43178@gmail.com', 'City Council');  // Sender email and name
    $mail->addAddress('recipient-email@example.com', 'Recipient Name'); 

    // Email content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Welcome to City Council!';
    $mail->Body    = 'Dear Recipient Name,<br><br>Thank you for registering with us. Your registration is successful!<br><br>Best Regards,<br>City Council';
    $mail->AltBody = 'Dear Recipient Name, Thank you for registering with us. Your registration is successful! Best Regards, City Council'; // Plain text for non-HTML mail clients

    // Send email
    if ($mail->send()) {
        echo 'Email has been sent successfully!';
    } else {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
} catch (Exception $e) {
    echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
