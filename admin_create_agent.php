<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'conn.php';

    $agentType = mysqli_real_escape_string($conn, $_POST['agentType']);
    $firstName = mysqli_real_escape_string($conn, $_POST['firstname']);
    $middleInitial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastname']);
    $contactNumber = mysqli_real_escape_string($conn, $_POST['contact_number']);
    $cityAddress = mysqli_real_escape_string($conn, $_POST['city_address']);

    $sql = "INSERT INTO tblagents (agent_type, firstname, middlename, lastname, contactno, fulladdress)
            VALUES ('$agentType', '$firstName', '$middleInitial', '$lastName', '$contactNumber', '$cityAddress')";

    if (mysqli_query($conn, $sql)) {
        $response = [
            'status' => 'success',
            'message' => 'New agent successfully created!'
        ];
    } else {
        $response = [
            'status' => 'error',
            'message' => 'There was an error creating the customer.',
            'error' => mysqli_error($conn)
        ];
    }

    mysqli_close($conn);

    echo json_encode($response);
    exit();
}
?>
