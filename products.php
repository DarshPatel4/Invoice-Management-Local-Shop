<?php
// customers.php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "invoice_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer data
$sql = "SELECT id, name, description,price FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>Products</h2>
    <table>
        <tr>
            <th>id</th>
            <th>name</th>
            <th>Description</th>
            <th>price</th>
        </tr>
        <?php
 
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
          echo "<tr><td>" . $row["id"]. "</td><td>" . $row["name"]. "</td><td>" . $row["description"]. "</td><td>" . $row["price"]. "</td></tr>";
      }
  } else {
      echo "<tr><td colspan='4'>No products found</td></tr>";
  }

  
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>