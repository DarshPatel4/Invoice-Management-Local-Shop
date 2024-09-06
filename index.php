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
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
            </main>
        </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
