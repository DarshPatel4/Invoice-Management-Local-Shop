<?php
 
$link=mysqli_connect("localhost","root","");
mysqli_select_db($link,"invoice_system");

// Fetch product-wise sales data
$productSales = array();
$count = 0;
$res = mysqli_query($link,"SELECT product_name, SUM(quantity) AS total_quantity_per_product, SUM(quantity * price) AS per_product_total_price FROM invoice_products GROUP BY product_name;");
while($row = mysqli_fetch_array($res)) {
    $productSales[$count]["label"] = $row["product_name"];
    $productSales[$count]["y"] = $row["total_quantity_per_product"];
    $count = $count + 1;
}

// Fetch month-wise sales data
$monthSales = array();
$count = 0;
$res2 = mysqli_query($link,"SELECT DATE_FORMAT(invoice_date, '%M') as month, SUM(total_amount) AS total_sales FROM invoices GROUP BY month ORDER BY invoice_date;");
while($row2 = mysqli_fetch_array($res2)) {
    $monthSales[$count]["label"] = $row2["month"];
    $monthSales[$count]["y"] = $row2["total_sales"];
    $count = $count + 1;
}

?>


<!DOCTYPE HTML>
<html>
<head>
<script>
window.onload = function() {
 
// Chart for product-wise sales
var productChart = new CanvasJS.Chart("productChartContainer", {
	animationEnabled: true,
	theme: "light",
	title:{
		text: "Product-wise Sales"
	},
	axisY: {
		title: "Quantity"
	},
	axisX: {
		title: "Products",
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## pieces",
		dataPoints: <?php echo json_encode($productSales, JSON_NUMERIC_CHECK); ?>
	}]
});
productChart.render();

// Chart for month-wise sales
var monthChart = new CanvasJS.Chart("monthChartContainer", {
	animationEnabled: true,
	theme: "light",
	title:{
		text: "Month-wise Sales"
	},
	axisY: {
		title: "Total Sales (in Rupees)",
		minimum: 0 
	},
	axisX: {
		title: "Months",
	},
	data: [{
		type: "column",
		yValueFormatString: "#,##0.## Rupees",
		dataPoints: <?php echo json_encode($monthSales, JSON_NUMERIC_CHECK); ?>
	}]
});
monthChart.render();
}


</script>
</head>
<body>
<div id="productChartContainer" style="height: 400px; width: 49%; display: inline-block;"></div>
<div id="monthChartContainer" style="height: 400px; width: 49%; display: inline-block;"></div>
<script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
</body>
</html>