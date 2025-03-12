<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - The Store Of Knowledge</title>
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
            max-width: 600px;
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

    <!-- Admin Panel Content -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Welcome to Admin Panel</h5>
                        <p>This is the admin panel where you can manage various aspects of the BookStore.</p>
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
