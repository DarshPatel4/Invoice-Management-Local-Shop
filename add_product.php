

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost"; // XAMPP server
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password (empty)
    $dbname = "invoice_system"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind parameters
    $name = $_POST['productName'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    // Validate inputs
    if (empty($name) || empty($description) || empty($price)) {
        echo "<div class='error-message'>All fields are required.</div>";
    } else {
        $sql = "INSERT INTO products (name, description, price) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssd", $name, $description, $price); // "ssd" - string, string, double

            if ($stmt->execute()) {
                echo "<div class='success-message'>New product added successfully!</div>";
            } else {
                echo "<div class='error-message'>Error: " . $stmt->error . "</div>";
            }

            $stmt->close();
        } else {
            echo "<div class='error-message'>Error: " . $conn->error . "</div>";
        }
    }

    // Close the connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        .container1 {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        h2 {
            margin-bottom: 15px;
            font-size: 24px;
            text-align: left;
        }

        .form-group {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 8px 16px;
            font-size: 14px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: auto;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="container1">
        <h2>Add New Product</h2>
        <form method="post" action="">
            <div class="form-group">
                <label for="productName">Product Name:</label>
                <input type="text" id="productName" name="productName" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" id="price" name="price" required>
            </div>
            <button type="submit">Add Product</button>
        </form>
    </div>

</body>
</html>
