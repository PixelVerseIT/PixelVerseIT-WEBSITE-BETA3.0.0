<?php
//
//(C) COPYRIGHT 2023 PIXELVERSEIT. ALL RIGHTS RESERVED.
//
// Initialize variables
$message = 'Your message has been sent. Thank you!';
$success = true;

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Set up the database connection
    // Set up the database connection
    $db_host = "sql206.infinityfree.com";
    $db_user = "epiz_31943419";
    $db_pass = "1J4DjUH15GFCDEO";
    $db_name = "epiz_31943419_pixelverseitweb1CONTACTFORM";

    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Prepare and execute the SQL query to insert data into the database
    $sql = "INSERT INTO contact_form_submissions (name, email, subject, message) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $subject, $message);

    if ($stmt->execute()) {
        // Form submission was successful
        $success = true;
    } else {
        // Form submission failed
        $success = false;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
}
?>