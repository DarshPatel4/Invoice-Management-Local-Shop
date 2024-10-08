<?php
// Check if the 'file' parameter is set
if (isset($_GET['file']) && !empty($_GET['file'])) {
    // Sanitize the input to prevent file path attacks
    $file = basename($_GET['file']);
    
    // Set the file path
    $filePath = 'invoices/' . $file;

    // Check if the file exists
    if (file_exists($filePath)) {
        // Set headers for file download
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "Error: File does not exist.";
    }
} else {
    echo "Error: No file specified.";
}
?>
