<?php
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define your database connection credentials
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fir"; // Your database name

    // Establish a database connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the database connection
    if ($conn->connect_error) {
        // If connection fails, send an error response
        $response = ['success' => false, 'message' => 'Database connection failed.'];
    } else {
        // If connection succeeds, insert data into the database (you'll need to replace these placeholders with actual form data)
        // Example: $fullname = isset($_POST['fullname']) ? $_POST['fullname'] : '';
        // Perform validation and sanitization on the form data before inserting into the database

        // Insert SQL statement (replace placeholders with actual column names)
        $stmt = $conn->prepare("INSERT INTO fir_entries (fullname, contactnumber, presentaddress, EmailAddress, DateIncident, Location, incidentType, othersDescription, DetailedDescription, DescriptionsofIndividuals, Witnesses, ContactInformation, Statements, datetime, section, OtherRelevant) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters to the SQL statement
        $stmt->bind_param("ssssssssssssssss", $fullname, $contactnumber, $presentaddress, $EmailAddress, $DateIncident, $Location, $incidentType, $othersDescription, $DetailedDescription, $DescriptionsofIndividuals, $Witnesses, $ContactInformation, $Statements, $datetime, $section, $OtherRelevant);

        // Execute the SQL statement
        if ($stmt->execute()) {
            // If execution is successful, send a success response
            $response = ['success' => true, 'message' => 'FIR filed successfully.'];
        } else {
            // If execution fails, send an error response
            $response = ['success' => false, 'message' => 'Error filing FIR.'];
        }

        // Close the statement
        $stmt->close();
    }

    // Close the database connection
    $conn->close();

    // Send the response as JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // If request method is not POST, send a method not allowed response
    header('HTTP/1.1 405 Method Not Allowed');
    echo 'Method Not Allowed';
}
?>
