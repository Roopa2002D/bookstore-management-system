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
    $adminUsername = $_POST["username"];
    $adminPassword = $_POST["password"];

    // Validate admin credentials
    $sql = "SELECT * FROM admin WHERE adminid = '$adminUsername' AND password = '$adminPassword'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $_SESSION["admin_username"] = $adminUsername;
        header("Location: adminPanel.php");
        exit();
    } else {
        header("Location: errorAdminLogin.html");
        exit();
    }
}

$conn->close();
?>
