<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']); // Decode URL-encoded file path

    // Sanitize the input to avoid path traversal attacks
    $file = basename($file);

    $filePath = 'invoices/' . $file; // Adjust path if necessary

    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid request.";
}
?>
