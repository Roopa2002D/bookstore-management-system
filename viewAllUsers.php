<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View All Users - The Store Of Knowledge</title>
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
                    </li
					<li class="nav-item">
                        <a class="nav-link" href="viewCategory.php">View Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="viewAllUsers.php">View Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- View All Users Content -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">View All Users</h5>
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

                        $sql = "SELECT * FROM users";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            echo '<table class="table table-bordered">';
                            echo '<thead><tr><th>User ID</th><th>Name</th><th>Phone</th><th>Address</th><th>Place</th><th>Email</th><th>Delete</th></tr></thead>';
                            echo '<tbody>';
                            while ($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . $row["userid"] . '</td>';
                                echo '<td>' . $row["name"] . '</td>';
                                echo '<td>' . $row["phone"] . '</td>';
                                echo '<td>' . $row["address"] . '</td>';
                                echo '<td>' . $row["place"] . '</td>';
                                echo '<td>' . $row["email"] . '</td>';
                                echo '<td><a href="DeleteUser.php?id=' . $row["id"] . '" class="btn btn-danger btn-sm">Delete</a></td>';
                                echo '</tr>';
                            }
                            echo '</tbody></table>';
                        } else {
                            echo '<p>No users found.</p>';
                        }

                        $conn->close();
                        ?>
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
