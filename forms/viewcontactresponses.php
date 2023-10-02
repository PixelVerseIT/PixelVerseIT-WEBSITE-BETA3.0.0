<?php
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

// Retrieve form responses from the database
$sql = "SELECT * FROM contact_form_submissions ORDER BY id DESC";
$result = $conn->query($sql);

// Display the form responses in a table
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Admin Dashboard - Form Responses</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Subject</th>
            <th>Message</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                // Make the email address clickable with mailto link
                echo "<td><a href='mailto:" . $row['email'] . "?subject=Response%20to:%20" . rawurlencode($row['subject']) . "%20|%20PixelVerseIT&body=" . rawurlencode("Kind Regards,\nPixelVerseIT\n\n----------------------------------------------------------------------------------------------------------------------------------------------------\n\nYou said (" . $row['email'] . ") via PixelVerseIT Online Contact Form:\n\n" . strip_tags(nl2br($row['message']))) . "'>" . $row['email'] . "</a></td>";
                echo "<td>" . $row['subject'] . "</td>";
                // Display the message with different lines using nl2br()
                echo "<td>" . nl2br($row['message']) . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No form responses found.</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
