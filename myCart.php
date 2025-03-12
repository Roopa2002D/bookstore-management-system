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

// Retrieve cart data for the current user
$userid = $_SESSION['user_username'];
$sql_cart = "SELECT * FROM cart WHERE userid = '$userid'";
$result_cart = $conn->query($sql_cart);

// Delete item from cart
if (isset($_GET['delete']) && isset($_GET['bookid'])) {
    $delete_bookid = $_GET['bookid'];
    $sql_delete = "DELETE FROM cart WHERE userid = '$userid' AND bookid = '$delete_bookid'";
    $conn->query($sql_delete);
    header("Location: myCart.php");
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cart - The Store Of Knowledge</title>
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
            max-width: 800px;
            box-shadow: 0px 3px 10px rgba(0, 0, 0, 0.1);
        }
        .card-title {
            font-size: 20px;
            font-weight: bold;
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
                    <li class="nav-item active">
                        <a class="nav-link" href="myCart.php">My Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Cart Items -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">My Cart</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Book ID</th>
                                   
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
								$total_price =0;
                                while ($row_cart = $result_cart->fetch_assoc()) {
                                    $bookid = $row_cart["bookid"];
                                    $quantity = $row_cart["quantity"];
                                    $price = floatval($row_cart["price"]);
                                    $total_price +=  $price;

                                    echo "<tr>";
                                    echo "<td>$bookid</td>";
                                    
                                    echo "<td>$" . number_format($price, 2) . "</td>";
                                    echo "<td>$quantity</td>";
                                    echo "<td>$" . number_format($total_price, 2) . "</td>";
                                    echo "<td><a href='myCart.php?delete=true&bookid=$bookid' class='btn btn-sm btn-danger'>Delete</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                        <a href="viewBooks.php" class="btn btn-primary">Continue Shopping</a>
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
