<?php
if (isset($_GET['code'])) {
    $pincode = $_GET['code'];

    $apiUrl = "https://api.postalpincode.in/pincode/{$pincode}";
    $response = file_get_contents($apiUrl);
    $data = json_decode($response, true);

    if ($data[0]['Status'] === 'Success') {
        $district = $data[0]['PostOffice'][0]['District'];
        $state = $data[0]['PostOffice'][0]['State'];
        echo json_encode(['district' => $district, 'state' => $state]);
    } else {
        echo json_encode(['error' => 'Invalid PIN code']);
    }
}



?>
