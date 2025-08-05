<?php
// Include your database connection file
include 'conn.php';

// Response array
$response = array();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Escape user inputs for security
    $customerId = mysqli_real_escape_string($conn, $_POST['customer_id']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middleInitial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastname']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $cityAddress = mysqli_real_escape_string($conn, $_POST['city_address']);

    // Update query
    $sql = "UPDATE tblagents SET firstname='$firstName', middlename='$middleInitial', lastname='$lastName', contactno='$contactNumber', fulladdress='$cityAddress' WHERE agent_id='$customerId'";        

    if (mysqli_query($conn, $sql)) {
        // If update is successful, send success response
        $response['status'] = 'success';
        $response['message'] = 'Agent updated successfully!';
    } else {
        // If there's an error with the query, send error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating record: ' . mysqli_error($conn);
    }

    // Close connection
    mysqli_close($conn);
} else {
    // Invalid request
    $response['status'] = 'error';
    $response['message'] = 'Invalid request.';
}

// Send response as JSON
echo json_encode($response);
?>
