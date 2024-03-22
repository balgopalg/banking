<?php
if (isset($_REQUEST['get_ifsc'])) {
    $ifsc_code = $_REQUEST['ifsc'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://ifsc.razorpay.com/$ifsc_code",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
    ]);

    $response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        if ($http_status == 200) {
            $json_decode = json_decode($response, true);
            echo "<table class='styled-table'>";
            echo "<thead><th colspan='2'>BRANCH DETAILS</th></thead>";
            echo "<tbody>";
            echo "<tr><td>BANK</td><td>{$json_decode['BANK']}</td></tr>";
            echo "<tr><td>IFSC</td><td>{$json_decode['IFSC']}</td></tr>";
            echo "<tr><td>BRANCH NAME</td><td>{$json_decode['BRANCH']}</td></tr>";
            echo "<tr><td>MICR</td><td>{$json_decode['MICR']}</td></tr>";
            echo "<tr><td>BANKCODE</td><td>{$json_decode['BANKCODE']}</td></tr>";
            echo "<tr><td>CONTACT</td><td>{$json_decode['CONTACT']}</td></tr>";
            echo "<tr><td>CENTRE</td><td>{$json_decode['CENTRE']}</td></tr>";
            echo "<tr><td>City</td><td>{$json_decode['CITY']}</td></tr>";
            echo "<tr><td>STATE</td><td>{$json_decode['STATE']}</td></tr>";
            echo "<tr><td>ISO3166</td><td>{$json_decode['ISO3166']}</td></tr>";
            echo "</tbody></table>";
        } else {
            echo "Error: HTTP Status $http_status";
        }
    }
}
