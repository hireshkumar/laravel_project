<?php 
// Include the necessary file (Make sure the path is correct)
include("file.blade.php");

// Check if 'ID' and 'status' are set
if (isset($_GET['ID']) && isset($_GET['status'])) {
    // Sanitize input to prevent SQL Injection
    $id = intval($_GET['ID']);  // Assuming ID is an integer
    $status = intval($_GET['status']);  // Assuming status is an integer

    // Prepare the SQL query using prepared statements
    $updatequery1 = "UPDATE students SET status = ? WHERE id = ?";
    
    // Check connection to the database
    if ($student_data = mysqli_connect("localhost", "username", "password", "database_name")) {
        // Prepare the statement
        if ($stmt = mysqli_prepare($student_data, $updatequery1)) {
            // Bind parameters and execute the statement
            mysqli_stmt_bind_param($stmt, "ii", $status, $id);  // "ii" for two integers
            mysqli_stmt_execute($stmt);
            
            // Close the statement
            mysqli_stmt_close($stmt);
        } else {
            // Handle SQL errors if the statement preparation failed
            echo "Error preparing the SQL query.";
        }
    } else {
        // Handle connection errors
        echo "Failed to connect to the database.";
    }
    
    // Redirect to the records page
    header('Location: records.blade.php');
    exit();  // Always call exit() after header redirect
} else {
    echo "Invalid ID or status.";
}
?>








?>
