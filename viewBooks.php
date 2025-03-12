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

// Retrieve all books from the database
$sql = "SELECT DISTINCT booktype FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books - The Store Of Knowledge</title>
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
    </style>
</head>
<body>
    <!-- Title Bar -->
    <nav class="navbar navbar-expand-lg title-bar">
        <div class="container">
            <a class="navbar-brand" href="index.html">The Store Of Knowledge</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="myPanel.php">My Panel</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="myCart.php">My Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Category Selection -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">Select Category:</h4>
                                    </div>
                                    <div class="panel-body">
                                        <form action="#" method="post">
                                            <div class="form-group">
                                                <select class="form-control" id="category" name="category">
                                                    <?php
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            echo '<option value="' . $row["booktype"] . '">' . $row["booktype"] . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Show Books</button>
                                        </form>
										<hr/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $selected_category = $_POST["category"];

                            // Retrieve books of the selected category
                            $sql_books = "SELECT * FROM books WHERE booktype = '$selected_category'";
                            $result_books = $conn->query($sql_books);
                        ?>
                        <div class="d-flex justify-content-end mb-3">
                            <a href="checkout.php" class="btn btn-primary">Checkout</a>
                        </div>
                        <h5 class="card-title">Books - <?php echo $selected_category; ?></h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                    <th>Book Name</th>
                                    <th>Publication</th>
                                    <th>Year of Publication</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Book Image</th>
                                    <th>Add to Cart</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result_books->num_rows > 0) {
                                    while ($row = $result_books->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["bookid"] . "</td>";
                                        echo "<td>" . $row["bookname"] . "</td>";
                                        echo "<td>" . $row["publication"] . "</td>";
                                        echo "<td>" . $row["year_of_pub"] . "</td>";
                                        echo "<td>$" . $row["price"] . "</td>";
                                        echo "<td>" . $row["quantity"] . "</td>";
                                        echo '<td><img src="BookImages/' . $row["bookimage"] . '" class="book-img"></td>';
                                        echo '<td><a href="AddToCart.php?bookid=' . $row["bookid"] . '&price=' . $row["price"] . '" class="btn btn-success btn-sm">Add to Cart</a></td>';
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No books found.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
