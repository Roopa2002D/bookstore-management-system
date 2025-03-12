<?php
session_start();
// Connect to the database (Update these values with your actual database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userid = $_POST["userid"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $place = $_POST["place"];
    $email = $_POST["email"];

    // Insert user data into the database
    $sql = "INSERT INTO users (userid, password, name, phone, address, place, email) VALUES ('$userid', '$password', '$name', '$phone', '$address', '$place', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION["user_username"] = $userid;
        header("Location: userRegisterSuccess.html");
        exit();
    } else {
        header("Location: userRegisterFail.html");
        exit();
    }
}

$conn->close();
?>
