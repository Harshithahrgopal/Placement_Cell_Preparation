<?php
session_start();  

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";  

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $phone = $_POST['phone'];
    $year = $_POST['year'];
    $cgpa = $_POST['cgpa'];
    $skills = $_POST['skills'];

    if ($password !== $confirm_password) {
        echo "<p style='color: red;'>Passwords do not match! Please try again.</p>";
        exit(); 
    }

    if (!empty($username) && !empty($email) && !empty($password) && !empty($phone) && !empty($year) && !empty($cgpa) && !empty($skills)) {
       
        $sql = "INSERT INTO form (username, email, password,confirm_password, phone, year, cgpa, skills) 
                VALUES ('$username', '$email', '$password','$confirm_password ','$phone', '$year', '$cgpa', '$skills')";

        if ($conn->query($sql) === TRUE) {
           
            $_SESSION['username'] = $username; 
            $_SESSION['email'] = $email;

            echo "<p style='color: green;'>Registration successful! Redirecting...</p>";
            header("refresh:2; url=links.html");  
            exit();  
        } else {
          
            echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color: red;'>Please fill in all fields.</p>";
    }
}

$conn->close();
?>
