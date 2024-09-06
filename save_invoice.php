<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'invoice_system');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the invoice statement
$stmt = $conn->prepare("INSERT INTO invoices (invoice_date, due_date, invoice_type, invoice_status, customer_name, address_1, address_2, town, postcode, country, email, phone_number, additional_notes, sub_total, tax, total_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssssssssdd", $invoice_date, $due_date, $invoice_type, $invoice_status, $customer_name, $address_1, $address_2, $town, $postcode, $country, $email, $phone_number, $additional_notes, $sub_total, $tax, $total_amount);

// Assign values from POST data
$invoice_date = $_POST['invoice_date'];
$due_date = $_POST['due_date'];
$invoice_type = $_POST['invoice_type'];
$invoice_status = $_POST['invoice_status'];
$customer_name = $_POST['customer_name'];
$address_1 = $_POST['address_1'];
$address_2 = $_POST['address_2'];
$town = $_POST['town'];
$postcode = $_POST['postcode'];
$country = $_POST['country'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$additional_notes = $_POST['additional_notes'];
$sub_total = $_POST['sub_total'];
$tax = $_POST['tax'];
$total_amount = $_POST['total_amount'];

// Execute the invoice statement
$stmt->execute();

// Get the last inserted invoice ID
$invoice_id = $conn->insert_id;

// Prepare and bind the invoice products statement
$product_stmt = $conn->prepare("INSERT INTO invoice_products (invoice_id, product_name, quantity, price, discount) VALUES (?, ?, ?, ?, ?)");
$product_stmt->bind_param("isidd", $invoice_id, $product_name, $quantity, $price, $discount);

// Loop through products
foreach ($_POST['product_name'] as $key => $value) {
    $product_name = $_POST['product_name'][$key];
    $quantity = $_POST['quantity'][$key];
    $price = $_POST['price'][$key];
    $discount = $_POST['discount'][$key];

    // Execute the product statement
    $product_stmt->execute();
}

// Close the statements and connection
$product_stmt->close();
$stmt->close();
$conn->close();

// Include FPDF library
require('fpdf186/fpdf.php'); // Ensure you have FPDF library installed

class PDF extends FPDF {
    function Header() {
        // Add logo
        $this->Image('images/logo.png', 10, 6, 30); // Adjust the path and size as needed
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'The Offline Store', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function InvoiceDetails($data) {
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, 'Invoice Details', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);

        // Create a three-column layout
        // $this->Cell(60, 7, 'Order ID:', 0, 0);
        $this->Cell(60, 7, '', 0, 0);
        $this->Cell(60, 7, '', 0, 1);

        // Print the order details in three columns
        $this->SetFont('Arial', '', 10);
        $this->Cell(60, 7, $data['id'], 0, 0);
        $this->Cell(60, 7, $data['Customer Name'], 0, 0);
        $this->Cell(60, 7, $data[''], 0, 1);

        // $this->Cell(60, 7, 'Order Date: ' . $data['Order Date'], 0, 0);
        $this->Cell(60, 7, $data['Address 1'], 0, 0);
        $this->Cell(60, 7, $data['Address 2'], 0, 1);

        $this->Cell(60, 7, 'Invoice Date: ' . $data['Invoice Date'], 0, 0);
        // $this->Cell(60, 7, $data['Address 2'], 0, 0);
        // $this->Cell(60, 7, $data['Address 2'], 0, 1);

        // $this->Cell(60, 7, 'PAN: ' . $data['PAN'], 0, 0);
        $this->Cell(60, 7, $data['Town'] . ', ' . $data['Postcode'], 0, 0);
       // $this->Cell(60, 7, $data['Town'] . ', ' . $data['Postcode'], 0, 1);

        $this->Cell(60, 7, '', 0, 0);
        $this->Cell(60, 7, $data['Country'], 0, 0);
        //$this->Cell(60, 7, $data['Country'], 0, 1);

        $this->Cell(60, 7, '', 0, 0);
        $this->Cell(60, 7, 'Phone: ' . $data['Phone Number'], 0, 0);
        //$this->Cell(60, 7, 'Phone: ' . $data['Phone Number'], 0, 1);

        $this->Ln(10);
    }
    function ProductTable($header, $products) {
        // Table Header
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(230, 230, 230); // Grey fill color
        foreach ($header as $col) {
            $this->Cell(47.5, 7, $col, 1, 0, 'C', true);
        }
        $this->Ln();

        // Table Body
        $this->SetFont('Arial', '', 10);
        $this->SetFillColor(255, 255, 255); // White fill color
        foreach ($products as $row) {
            foreach ($row as $col) {
                $this->Cell(47.5, 6, $col, 1, 0, 'C');
            }
            $this->Ln();
        }
    }

    function TotalAmount($sub_total, $tax, $total_amount) {
        // Display the total amount and tax
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Summary', 0, 1, 'L');
        $this->SetFont('Arial', '', 10);
        $this->Cell(95, 6, 'Sub Total:', 1);
        $this->Cell(95, 6, number_format($sub_total, 2), 1, 1, 'R');
        $this->Cell(95, 6, 'Tax:', 1);
        $this->Cell(95, 6, number_format($tax, 2), 1, 1, 'R');
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(95, 6, 'Total Amount:', 1);
        $this->Cell(95, 6, number_format($total_amount, 2), 1, 1, 'R');
    }
}

// Create a new PDF document
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

// Invoice Details
$invoice_data = [
    'Invoice ID' => $invoice_id, // Display the invoice ID
    'Invoice Date' => $invoice_date,
    'Due Date' => $due_date,
    'Customer Name' => $customer_name,
    'Address 1' => $address_1,
    'Address 2' => $address_2,
    'Town' => $town,
    'Postcode' => $postcode,
    'Country' => $country,
    'Email' => $email,
    'Phone Number' => $phone_number
];

$pdf->InvoiceDetails($invoice_data);

// Product Table
$header = ['Product Name', 'Quantity', 'Price', 'Discount'];
$products = [];

foreach ($_POST['product_name'] as $key => $value) {
    $products[] = [
        $_POST['product_name'][$key],
        $_POST['quantity'][$key],
        $_POST['price'][$key],
        $_POST['discount'][$key]
    ];
}

$pdf->ProductTable($header, $products);

// Total Amount Section
$pdf->TotalAmount($sub_total, $tax, $total_amount);

// Define PDF file path
$pdf_directory = 'invoices/';

// Check if directory exists, if not, create it
if (!is_dir($pdf_directory)) {
    mkdir($pdf_directory, 0755, true);
}

// Ensure directory is writable
if (!is_writable($pdf_directory)) {
    die('The invoices directory is not writable. Please check permissions.');
}

// Output the PDF
$pdf_filename = $pdf_directory . 'Invoice_' . $invoice_id . '.pdf';
$pdf->Output('F', $pdf_filename); // Save to folder

echo "Invoice saved successfully and PDF generated at: " . $pdf_filename;
?>
