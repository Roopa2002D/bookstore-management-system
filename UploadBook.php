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
    $bookname = $_POST["bookname"];
    $booktype = $_POST["booktype"];
    $publication = $_POST["publication"];
    $year_of_pub = $_POST["year_of_pub"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $bookimage = $_FILES["bookimage"]["name"];
    $target_dir = "BookImages/";
    $target_file = $target_dir . basename($_FILES["bookimage"]["name"]);

    // Upload the image to the BookImages directory
    move_uploaded_file($_FILES["bookimage"]["tmp_name"], $target_file);

    // Insert book details into the database
    $sql = "INSERT INTO books (bookid, bookname, booktype, publication, year_of_pub, price, quantity, bookimage) VALUES ('$bookid', '$bookname', '$booktype', '$publication', '$year_of_pub', '$price', '$quantity', '$bookimage')";
    if ($conn->query($sql) === TRUE) {
        header("Location: bookAddedSuccess.html");
        exit();
    } else {
        header("Location: bookAddedFail.html");
        exit();
    }
}

$conn->close();
?>
