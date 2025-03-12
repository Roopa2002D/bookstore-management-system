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
    $bookid = $_POST["bookid"];
    $transactionType = $_POST["transaction_type"];
    $invoiceID = $_POST["invoice_id"];
    $details = $_POST["details"];

    // Insert book return data into the database
    $sql = "INSERT INTO book_returns (bookid, transaction_type, invoice_id, details) VALUES ('$bookid', '$transactionType', '$invoiceID', '$details')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: returnSuccess.html");
        exit();
    } else {
        header("Location: returnFail.html");
        exit();
    }
}

$conn->close();
?>
