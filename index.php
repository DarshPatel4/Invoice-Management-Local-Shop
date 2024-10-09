<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Offline Store</title>
    <link rel="stylesheet" href="styles.css">
    <!-- <link rel="stylesheet" href="style1.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
    /* General Styles */
    body {
        font-family: Arial, sans-serif;
        background-color: #f7f7f7;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* Container Styling */
    .container-fluid {
        max-width: 1200px;
        margin: 0 auto;
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
    }

    /* Headings */
    h2, h4 {
        color: #007bff;
        margin-bottom: 20px;
    }

    /* Labels and Form Controls */
    label {
        font-weight: bold;
        margin-top: 10px;
    }

    .form-control {
        border-radius: 5px;
        padding: 10px;
        margin-top: 5px;
        border: 1px solid #ced4da;
    }

    /* Form Group Spacing */
    .form-group {
        margin-bottom: 15px;
    }

    .row {
        margin-bottom: 15px;
    }

    /* Buttons Styling */
    button[type="submit"], .btn-success {
        background-color: #007bff;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    button[type="submit"]:hover, .btn-success:hover {
        background-color: #0056b3;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn-success:hover {
        background-color: #218838;
    }

    /* Product Item Section */
    .product-item {
        padding: 10px;
        background-color: #f9f9f9;
        border: 1px solid #e9e9e9;
        border-radius: 5px;
        margin-bottom: 15px;
    }

    #addProduct {
        margin-top: 20px;
    }

    /* Readonly Input Styling */
    input[readonly] {
        background-color: #e9ecef;
        border-color: #ced4da;
    }

    /* Textarea Styling */
    .form-group textarea {
        resize: vertical;
    }

    /* Margin Utilities */
    .mt-4 {
        margin-top: 1.5rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .container-fluid {
            padding: 10px;
        }

        h2, h4 {
            font-size: 1.5rem;
        }
    }
</style>

</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <div class="logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <nav class="nav">
                <ul>
                    <li><a href="index.php?page=dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-file-invoice"></i> Invoices <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="index.php?page=view_invoices">View Invoices</a> <!-- Updated to match 'view_invoices' -->
                            <a href="index.php?page=add_invoice">Add Invoice</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-box"></i> Products <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="index.php?page=products">View Products</a>
                            <a href="index.php?page=add_product">Add Product</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-users"></i> Customers <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="index.php?page=customers">View Customers</a>
                            <a href="index.php?page=add_customer">Add Customer</a> <!-- Fixed missing page parameter -->
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user-cog"></i> System Users <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="index.php?page=system_users">View System Users</a>
                            <a href="index.php?page=add_system_user">Add System User</a>
                        </div>
                    </li>
                    <li class="dropdown">
                        <a href="javascript:void(0)" class="dropbtn"><i class="fas fa-user-cog"></i> Data Analysis <i class="fas fa-caret-down"></i></a>
                        <div class="dropdown-content">
                            <a href="data_analysis.php">Data Analysis</a>
                        </div>
                    </li>
                </ul>
            </nav>
        </aside>
        <div class="main-content">
            <header class="header">
                <div class="logout">
                    <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </header>
            <main class="content">
                <?php
                $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

                if ($page == 'dashboard') {
                    include 'dashboard.php';
                } elseif ($page == 'add_invoice') {
                    include 'add_invoice.php';
                } elseif ($page == 'view_invoices') {  // Changed to match the sidebar link
                    include 'view_invoices.php';
                } elseif ($page == 'add_product') {
                    include 'add_product.php';
                } elseif ($page == 'products') { // Added condition to match 'products' page
                    include 'products.php';
                } elseif ($page == 'customers') {
                    include 'customer.php';
                } elseif ($page == 'add_customer') {
                    include 'add_customer.php';
                } elseif ($page == 'system_users') {
                    include 'system_users.php';
                } elseif ($page == 'add_system_user') {
                    include 'add_system_user.php';
                } else {
                    echo "<h1>Page not found</h1>";
                }
                ?>
                <div class="charts">


</div>
            </main>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
