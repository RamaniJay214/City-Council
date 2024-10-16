<?php
// Include PHPMailer files
require 'C:\PHPMailer-master\src\Exception.php';
require 'C:\PHPMailer-master\src\PHPMailer.php';
require 'C:\PHPMailer-master\src\SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Database connection
    $conn = new mysqli("localhost", "root", "jay@6125", "city_council"); // Update your database name

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $dob = $_POST['dob'];
    $occupation = $_POST['occupation'];

    // Insert data into the database
    $sql = "INSERT INTO customer (Name, password, PhoneNumber, Email, Occupation, Address, DOB) VALUES ('$name', '$password', '$mobile', '$email', '$occupation', '$address', '$dob')";

    if ($conn->query($sql) === TRUE) {
        // If the registration is successful, send a welcome email using PHPMailer
        
        // Create an instance of PHPMailer
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

            // Recipients
            $mail->setFrom('jayr43178@gmail.com', 'City Council');  // Sender email and name
            $mail->addAddress($email, $name);                        // Add recipient

            // Email content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Welcome to City Council!';
            $mail->Body    = "Dear $name,<br><br>Welcome to <b>City Council</b>! We're thrilled to have you on board.

Your account has been successfully created, and you're now part of a community that makes accessing city services easier and more efficient. Here’s what you can do next:<br><br>
Explore Services: Start browsing the various services we offer.<br><br>
Submit Requests: Quickly file non-urgent reports or requests.<br><br>
Manage Your Profile: Update your details anytime.<br><br>
Stay Connected: Reach out to our support team via chat or email for any assistance.<br><br>
If you have any questions or need help getting started, feel free to contact us at [support email].<br><br>

We look forward to serving you!<br><br>

Best regards,<br><br>
City Council Team
Best Regards,<br>City Council";
            $mail->AltBody = "Dear $name, Thank you for registering with us. Your registration is successful! Best Regards, City Council"; // Plain text for non-HTML mail clients

            // Send email
            if ($mail->send()) {
                echo 'Registration successful. A welcome email has been sent to your email address.';
                
            } else {
                echo 'Registration successful, but the welcome email could not be sent.';
            }
        } catch (Exception $e) {
            echo "Registration successful, but email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
