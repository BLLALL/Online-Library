<?php
// Get the filename from the query parameter
$filename = isset($_GET['file']) ? $_GET['file'] : null;

if ($filename) {
    // Define the path to the file
    $filepath = "books/" . $filename;

    // Check if the file exists
    if (file_exists($filepath)) {
        // Set appropriate headers
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));

        // Read the file and output it to the browser
        readfile($filepath);
        exit;
    } else {
        echo "File not found.";
    }
} else {
    echo "Invalid file parameter.";
}
?>