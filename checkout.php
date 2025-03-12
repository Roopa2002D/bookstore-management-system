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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mode_pay = $_POST["mode_pay"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $billing_date = $_POST["billing_date"];

    // Calculate total amount and particulars from cart data
    $total_amount = 0;
    $particulars = '';
	$total_price = 0;
    while ($row_cart = $result_cart->fetch_assoc()) {
        $bookid = $row_cart["bookid"];
        $quantity = $row_cart["quantity"];
        $price = floatval($row_cart["price"]);
        $total_price += $price;

        // Check if there is enough stock before reducing quantity
        $sql_check_stock = "SELECT quantity FROM books WHERE bookid = '$bookid'";
        $result_stock = $conn->query($sql_check_stock);

        if ($result_stock->num_rows > 0) {
            $row_stock = $result_stock->fetch_assoc();
            $current_stock = intval($row_stock["quantity"]);

            if ($quantity <= $current_stock) {
                // Reduce quantity in books table
                $new_stock = $current_stock - $quantity;
                $sql_reduce_stock = "UPDATE books SET quantity = '$new_stock' WHERE bookid = '$bookid'";
                $conn->query($sql_reduce_stock);
            } else {
                // Not enough stock, show error
                header("Location: noStock.html");
                exit();
            }
        } else {
            echo "Error: Book with ID $bookid not found.";
            exit();
        }

        $total_amount += $total_price;
        $particulars .= $bookid . ' x ' . $quantity . ', ';
    }

    // Remove trailing comma and space
    $particulars = rtrim($particulars, ', ');

    // Insert data into the finalcart table
    $sql_insert = "INSERT INTO finalcart (userid, phone, perticulars, totalamount, billingdate, mode_pay, address) VALUES ('$userid', '$phone', '$particulars', '$total_amount', '$billing_date', '$mode_pay', '$address')";

    if ($conn->query($sql_insert) === TRUE) {
        // Clear the user's cart
        $sql_clear_cart = "DELETE FROM cart WHERE userid = '$userid'";
        $conn->query($sql_clear_cart);

        // Check if the selected payment mode is "QR" and redirect accordingly
        if ($mode_pay === "QR") {
            header("Location: qrPayment.html");
            exit();
        } else {
            header("Location: checkoutSuccess.php");
            exit();
        }
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - BookStore</title>
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
            <a class="navbar-brand" href="index.html">BookStore</a>
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

    <!-- Checkout Form -->
    <div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Checkout</h5>
                    <!-- Display Cart Table Data -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Book ID</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
							$total_price = 0;
                            $total_amount = 0; // Initialize total_amount
                            while ($row_cart = $result_cart->fetch_assoc()) {
                                $bookid = $row_cart["bookid"];
                                $quantity = $row_cart["quantity"];
                                $price = floatval($row_cart["price"]);
                                $total_price +=  $price;

                                echo "<tr>";
                                echo "<td>$bookid</td>";
                                echo "<td>$quantity</td>";
                                echo "<td>$" . number_format($total_price, 2) . "</td>";
                                echo "</tr>";

                                $total_amount += $total_price; // Update total_amount
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="2">Total Amount:</th>
                                <th>$<?php echo number_format($total_amount, 2); ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    
                    <!-- Checkout Form -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="mode_pay">Mode of Payment</label>
                            <select class="form-control" id="mode_pay" name="mode_pay" required>
                                <option value="Cash On Delivery">Cash On Delivery</option>
                                <option value="QR">QR</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group">
                            <label for="billing_date">Billing Date</label>
                            <input type="date" class="form-control" id="billing_date" name="billing_date" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Pay</button>
                    </form>
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
