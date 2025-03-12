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
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books - The Store of Knowledge</title>
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
                        <a class="nav-link" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="books.php">Books</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userLogin.html">User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="adminLogin.html">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Category Selection and Book Display -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="category">Select Category:</label>
                        <select class="form-control" id="category" name="category">
                            <?php
                            // Connect to the database (Update these values with your actual database details)
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "bookstore";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Retrieve distinct categories from the books table
                            $sql_categories = "SELECT DISTINCT booktype FROM books";
                            $result_categories = $conn->query($sql_categories);

                            if ($result_categories->num_rows > 0) {
                                while ($row_category = $result_categories->fetch_assoc()) {
                                    $category = $row_category["booktype"];
                                    echo "<option value='$category'>$category</option>";
                                }
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Show Books</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selected_category = $_POST["category"];

        // Connect to the database (Update these values with your actual database details)
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bookstore";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Retrieve books of the selected category
        $sql_books = "SELECT * FROM books WHERE booktype = '$selected_category'";
        $result_books = $conn->query($sql_books);
        ?>

        <!-- Book Panels -->
        <div class="container mt-4">
            <div class="row">
                <?php
                $modalCounter = 1; // Initialize a counter for unique modal IDs
                while ($row_book = $result_books->fetch_assoc()) {
                    $bookid = $row_book["bookid"];
                    $bookname = $row_book["bookname"];
                    $price = $row_book["price"];
                    $bookimage = $row_book["bookimage"];
                    $publication = $row_book["publication"];
                    $year_of_pub = $row_book["year_of_pub"];
                    $quantity = $row_book["quantity"];
                    ?>

                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="BookImages/<?php echo $bookimage; ?>" alt="<?php echo $bookname; ?>" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $bookname; ?></h5>
                                <p class="card-text">$<?php echo $price; ?></p>
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#bookModal<?php echo $modalCounter; ?>">View Details</button>
                            </div>
                        </div>
                    </div>

                    <!-- Book Modal -->
                    <div class="modal fade" id="bookModal<?php echo $modalCounter; ?>" tabindex="-1" role="dialog" aria-labelledby="bookModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="bookModalLabel"><?php echo $bookname; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img src="BookImages/<?php echo $bookimage; ?>" alt="<?php echo $bookname; ?>" class="img-fluid mb-3">
                                    <p><strong>Price:</strong> $<?php echo $price; ?></p>
                                    <p><strong>Publication:</strong> <?php echo $publication; ?></p>
                                    <p><strong>Year of Publication:</strong> <?php echo $year_of_pub; ?></p>
                                    <p><strong>Quantity:</strong> <?php echo $quantity; ?></p>
                                    <!-- Add more book details here -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $modalCounter++; // Increment the counter for the next book
                }
                $conn->close();
                ?>
            </div>
        </div>
    <?php } ?>

    <!-- Bootstrap Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
