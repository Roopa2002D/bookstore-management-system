<?php
session_start();

// Check if the user is logged in or has appropriate permissions.
// You can add your authentication logic here.

// Connect to the database (Update these values with your actual database details)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if a book ID is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $bookId = $_GET['id'];

    // Fetch the book data from the database based on the provided book ID
    $sql = "SELECT * FROM books WHERE bookid = '$bookId'";
    $result = $conn->query($sql);

    if ($result->num_rows === 1) {
        $bookData = $result->fetch_assoc();
    } else {
        // Handle the case where the book with the given ID does not exist.
        echo "Book not found.";
        exit;
    }
} else {
    // Handle the case where no book ID is provided in the URL.
    echo "Invalid request.";
    exit;
}

// Handle form submission for updating book data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize the updated book data from the form
    $updatedBookName = mysqli_real_escape_string($conn, $_POST["bookname"]);
    $updatedBookType = mysqli_real_escape_string($conn, $_POST["booktype"]);
    $updatedPublication = mysqli_real_escape_string($conn, $_POST["publication"]);
    $updatedYearOfPublication = mysqli_real_escape_string($conn, $_POST["year_of_pub"]);
    $updatedPrice = mysqli_real_escape_string($conn, $_POST["price"]);
    $updatedQuantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

    // Update the book data in the database
    $updateSql = "UPDATE books SET
        bookname = '$updatedBookName',
        booktype = '$updatedBookType',
        publication = '$updatedPublication',
        year_of_pub = '$updatedYearOfPublication',
        price = '$updatedPrice',
        quantity = '$updatedQuantity'
        WHERE bookid = '$bookId'";

    if ($conn->query($updateSql) === TRUE) {
        // Redirect to a success page or the book listing page
        header("Location: viewAllBooks.php");
        exit;
    } else {
        echo "Error updating book: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Books - The Store Of Knowledge</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Customize your additional styles here */
        body {
            background-color: #f8f9fa;
        }
        .title-bar {
            background-color: #292b2c;
            color: #ffffff;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
        }
        .navbar-nav .nav-link {
            color: #ffffff;
        }
        .navbar-nav .nav-link:hover {
            color: #c2e2ff;
        }
        .card {
            border: none;
            margin: 20px auto;
            max-width: 1000px; /* Adjust the width as needed */
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
        }
        .book-img {
            max-width: 100px;
            max-height: 150px;
        }
        .custom-panel {
            margin-bottom: 15px;
        }
        .custom-panel-body {
            padding: 15px;
        }
    </style>
    
    <!-- Include meta tags, title, and CSS styles as needed -->
</head>
<body>
<nav class="navbar navbar-expand-lg title-bar">
        <div class="container">
            <a class="navbar-brand" href="index.html">The Store Of Knowledge</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="adminPanel.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addBook.php">Add Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addCategory.php">Add Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewAllBooks.php">View Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewCategory.php">View Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewAllUsers.php">View Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <h1>Edit Book</h1>
	<div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Adjust the column width as needed -->
                <div class="card">
                    <div class="card-body">
    <form method="POST" action="">
        <label for="bookname">Book Name:</label>
        <input type="text" name="bookname" id="bookname" value="<?php echo $bookData['bookname']; ?>"><br>

        <label for="booktype">Book Type:</label>
        <input type="text" name="booktype" id="booktype" value="<?php echo $bookData['booktype']; ?>"><br>

        <label for="publication">Publication:</label>
        <input type="text" name="publication" id="publication" value="<?php echo $bookData['publication']; ?>"><br>

        <label for="year_of_pub">Year of Publication:</label>
        <input type="text" name="year_of_pub" id="year_of_pub" value="<?php echo $bookData['year_of_pub']; ?>"><br>

        <label for="price">Price:</label>
        <input type="text" name="price" id="price" value="<?php echo $bookData['price']; ?>"><br>

        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" id="quantity" value="<?php echo $bookData['quantity']; ?>"><br>

        <input type="submit" value="Update">
    </form>
	</div>
                </div>
            </div>
        </div>
</body>
</html>
