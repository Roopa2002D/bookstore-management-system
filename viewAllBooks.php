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

// Define initial SQL query
$sql = "SELECT * FROM books";

// Check if a category is selected
if (isset($_GET['category']) && $_GET['category'] !== '') {
    $category = $_GET['category'];
    $sql .= " WHERE booktype = '$category'";
}

// Retrieve books from the database
$result = $conn->query($sql);
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

    <!-- View All Books -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12"> <!-- Adjust the column width as needed -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">All Books</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Name</th>
                                    <th>Book Type</th>
                                    <th>Publication</th>
                                    <th>Year of Publication</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Book Image</th>
                                    <th>Edit</th> <!-- Added Edit column -->
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["bookid"] . "</td>";
                                        echo "<td>" . $row["bookname"] . "</td>";
                                        echo "<td>" . $row["booktype"] . "</td>";
                                        echo "<td>" . $row["publication"] . "</td>";
                                        echo "<td>" . $row["year_of_pub"] . "</td>";
                                        echo "<td>" . $row["price"] . "</td>";
                                        echo "<td>" . $row["quantity"] . "</td>";
                                        echo '<td><img src="BookImages/' . $row["bookimage"] . '" class="book-img"></td>';
                                        // Add an Edit button that links to editBook.php with the book ID
                                        echo '<td><a href="editBook.php?id=' . $row["bookid"] . '" class="btn btn-primary btn-sm">Edit</a></td>';
                                        echo '<td><a href="DeleteBook.php?id=' . $row["bookid"] . '" class="btn btn-danger btn-sm">Delete</a></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='10'>No books found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <!-- ... (previous code for Bootstrap scripts) ... -->
</body>
</html>
