<?php
// Define the directory to scan
$dir = "./";

// Open the directory
if ($handle = opendir($dir)) {
    // Loop through the directory
    while (false !== ($file = readdir($handle))) {
        // Check if the file is a PHP file
        if (strpos($file, ".php") !== false) {
            // Display the file name
            echo "$file<br>";
        }
    }
    // Close the directory
    closedir($handle);
}
?>
