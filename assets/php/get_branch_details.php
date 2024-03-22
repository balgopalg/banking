<?php
require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
if(isset($_GET['branchName'])) {
    $branchName = $_GET['branchName'];
    $query = "SELECT * FROM branch WHERE BranchName = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $branchName);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result) > 0) {
        $branchDetails = mysqli_fetch_assoc($result);
        echo "<table class='styled-table'>";
        echo "<thead><th colspan='2'>BRANCH DETAILS</th></thead>";
        echo "<tbody>";
        echo "<tr><td>Branch Name</td><td>{$branchDetails['BranchName']}</td></tr>";
        echo "<tr><td>IFSC</td><td>{$branchDetails['IFSC']}</td></tr>";
        echo "<tr><td>Branch Manager</td><td>{$branchDetails['BranchManager']}</td></tr>";
        echo "<tr><td>Address</td><td>{$branchDetails['Address']}</td></tr>";
        echo "<tr><td>District</td><td>{$branchDetails['District']}</td></tr>";
        echo "<tr><td>State</td><td>{$branchDetails['State']}</td></tr>";
        echo "<tr><td>Pincode</td><td>{$branchDetails['Pincode']}</td></tr>";
        echo "<tr><td>Working Hours</td><td>{$branchDetails['WorkingHours']}</td></tr>";
        echo "<tr><td>Non Working Days</td><td>{$branchDetails['NonWorkingDays']}</td></tr>";
        echo "<tr><td>Classification</td><td>{$branchDetails['Classification']}</td></tr>";
        echo "<tr><td>Phone No</td><td>{$branchDetails['Phone']}</td></tr>";
        echo "<tr><td>Email</td><td>{$branchDetails['Email']}</td></tr>";
        echo "</tbody></table>";
    } else {
        echo "No branch details found for $branchName";
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo "Branch name parameter is missing.";
}
?>
