<?php
// Start the session
// session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Dummy data for sales (you can replace this with actual database data)
$productNames = ['Product A', 'Product B', 'Product C', 'Product D'];
$productSales = [150, 200, 125, 300];

$salesDates = ['2024-09-01', '2024-09-02', '2024-09-03', '2024-09-04'];
$salesAmounts = [120, 190, 150, 210];

$categoryLabels = ['Electronics', 'Furniture', 'Groceries', 'Clothing'];
$categorySales = [300, 150, 400, 200];
?>
<h2>Sales Report</h2>

<!-- Dropdown for selecting graph type -->
<label for="category">Select Graph Type:</label>
<select id="category" onchange="loadGraph()">
    <option value="bar">Bar Graph</option>
    <option value="line">Line Graph</option>
</select>

<!-- Canvas for the chart -->
<!-- <div>
    <canvas id="salesGraph"></canvas>
</div> -->

<main class="content">
    <!-- Bar Chart for Product Sales -->
    <div id="product-sales-container" class="chart-container">
        <h2>Sales per Product</h2>
        <canvas id="productSalesChart" width="300" height="200"></canvas>
    </div>

    <!-- Line Chart for Sales Over Time -->
    <div id="sales-over-time-container" class="chart-container">
        <h2>Sales Over Time</h2>
        <canvas id="salesOverTimeChart" width="300" height="200"></canvas>
    </div>

    <!-- Pie Chart for Sales Distribution by Category -->
    <div id="category-sales-container" class="chart-container">
        <h2>Sales Distribution by Category</h2>
        <canvas id="categorySalesChart" width="300" height="200"></canvas>
    </div>
</main>

<!-- Script for generating chart -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Bar Chart for Product Sales
    const productSalesCtx = document.getElementById('productSalesChart').getContext('2d');
    const productSalesChart = new Chart(productSalesCtx, {
        type: 'bar', 
        data: {
            labels: <?php echo json_encode($productNames); ?>,
            datasets: [{
                label: 'Sales per Product',
                data: <?php echo json_encode($productSales); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Line Chart for Sales Over Time
    const salesOverTimeCtx = document.getElementById('salesOverTimeChart').getContext('2d');
    const salesOverTimeChart = new Chart(salesOverTimeCtx, {
        type: 'line', 
        data: {
            labels: <?php echo json_encode($salesDates); ?>,
            datasets: [{
                label: 'Sales Over Time',
                data: <?php echo json_encode($salesAmounts); ?>,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                fill: true
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Pie Chart for Sales Distribution by Category
    const categorySalesCtx = document.getElementById('categorySalesChart').getContext('2d');
    const categorySalesChart = new Chart(categorySalesCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($categoryLabels); ?>,
            datasets: [{
                label: 'Sales Distribution by Category',
                data: <?php echo json_encode($categorySales); ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        }
    });
</script>

<style>
    /* CSS for smaller graphs */
    .chart-container {
        width: 320px;
        margin: 20px auto;
    }
    canvas {
        display: block;
        width: 100%;
        height: auto;
    }
</style>
