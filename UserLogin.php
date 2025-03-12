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
    $userUsername = $_POST["username"];
    $userPassword = $_POST["password"];

    // Validate user credentials
    $sql = "SELECT * FROM users WHERE userid = '$userUsername' AND password = '$userPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["user_username"] = $userUsername;
        header("Location: myPanel.php");
        exit();
    } else {
        header("Location: errorUserLogin.html");
        exit();
    }
}

$conn->close();
?>
