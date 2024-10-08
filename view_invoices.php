<?php 
// Connect to the database
include 'db_connection.php'; // Include your database connection file

// Fetch invoices from the database
$sql = "SELECT * FROM invoices ORDER BY created_at ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
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
        h2 {
            margin-bottom: 0;
        }
        .table-container {
            clear: both;
        }
        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
        }
    </style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Invoices</title>
</head>
<body>
    <div class="container">
        <h2>Invoices<br></h2>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>Invoice ID</th>
                        <th>Customer Name</th>
                        <th>Invoice Date</th>
                        <th>Due Date</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Total Amount</th>
                        <th>Download</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['customer_name']); ?></td>
                                <td><?php echo $row['invoice_date']; ?></td>
                                <td><?php echo $row['due_date']; ?></td>
                                <td><?php echo htmlspecialchars($row['invoice_type']); ?></td>
                                <td><?php echo htmlspecialchars($row['invoice_status']); ?></td>
                                <td><?php echo $row['total_amount']; ?></td>
                                <td>
                                    <!-- Properly structured download button -->
                                    <a href="download_invoice.php?file=<?php echo urlencode($row['pdf_path']); ?>" class="btn btn-success">
                                        Download
                                    </a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No invoices found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Close database connection
?>
