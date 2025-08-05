<?php
session_start();  

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "signin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    if (!empty($user) && !empty($email) && !empty($pass)) {

        $sql = "INSERT INTO form (username, email, password) VALUES ('$user', '$email', '$pass')";

        if ($conn->query($sql) === TRUE) {
            
            $_SESSION['user'] = $user;  
            $_SESSION['email'] = $email;

            echo "<p style='color: green;'>Login successful! Redirecting...</p>";
            header("refresh:2; url=links.html");  
            exit();  
        } else {
            
            echo "<p style='color: red;'>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Please fill in all fields.</p>";
    }
}

$conn->close();
?>
