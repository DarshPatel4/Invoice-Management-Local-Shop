<!-- invoices.php -->
<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'invoices';

if ($page == 'invoices') {
    echo '<h1>Invoices Page</h1><p>This is the invoices page content.</p>';
} elseif ($page == 'add_invoice') {
    echo '<h1>Add Invoice Page</h1><p>This is the add invoice page content.</p>';
}
?>
