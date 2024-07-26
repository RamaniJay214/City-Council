<?php
session_name('login');
session_start();

$servername = "localhost";
$dbname = "amc";
$db_username = "root";
$db_password = "jay@6125";

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $workspace = $_POST['workspace'];
    $password = $_POST['password'];

    // SQL query to fetch user data based on username
    $sql = "SELECT password, role FROM registration WHERE workspace = '$workspace'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($password == $row['password']) {
            // Store user data in session
           
            $_SESSION['workspace'] = $workspace;
            $_SESSION['role'] = $row['role'];

            // Redirect based on role
            if ($row['role'] == 'employee') {
                header("Location: pages-contact.html");
            }
             else{
                header("Location: index.php");
            }
        } 
        else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found.";
    }

    $conn->close();
}
?>
