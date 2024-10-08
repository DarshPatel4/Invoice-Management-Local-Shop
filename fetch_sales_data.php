<?php
// Include your database connection
include('config.php');

// Fetch monthly sales data from invoices table
$query = "SELECT MONTH(invoice_date) as month, SUM(total_price) as sales
          FROM invoices
          GROUP BY month";
$result = mysqli_query($conn, $query);

$sales_data = [];

while($row = mysqli_fetch_assoc($result)) {
    $sales_data[] = $row;
}

// Return the data as JSON
echo json_encode($sales_data);
?>
