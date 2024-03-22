<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="app.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</head>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
$email = $_SESSION['email'];
$get_employee = mysqli_query($conn, "SELECT * FROM employees,branch WHERE employees.EmployeeEmail = '$email' AND employees.EmployeeBranch=branch.ID");
$row = mysqli_fetch_assoc($get_employee);
$ifsc = $row['IFSC'];
?>

<body>
    <nav class="navbar">
        <div class="profile-nav">
            <div class="logo">
                <div>
                    <img src="/images/logo.jpg" alt="">
                </div>
                <p>Bank of Bhadrak</p>
            </div>
            <div class="profile">
                <div class="branchIFSC">
                    BRANCH : <?php echo  $ifsc; ?>
                </div>
                Welcome 👋 <?php echo strtoupper($row['EmployeeName']); ?>
                <div class="dropdown">
                    <img src="/images/manager.jpg" alt="">
                    <div class="items">
                        <a href="/assets/php/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>

    </nav>
    <div class="bottom-nav">
        <div class="s1">
            <ul>
                <li><a href="manager_dashboard.php">Search Accounts</a></li>
                <li><a href="loanApp.php">Loan Applications</a></li>
                <li><a href="hireEmployee.php">Hire Employee</a></li>
                <li><a href="rm_manager.php">RM Requests</a></li>
            </ul>
        </div>
        <div>
            <div class="tooltip">
                <a href=""> <button>
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </button>
                </a>
            </div>

        </div>
    </div>
    <style>
        .table {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px;
            min-height: 300px;
        }

        .dataTables_filter {
            margin-bottom: 15px;
        }

        .dataTables_wrapper {
            width: 1000px;
        }
    </style>
    <main>
        <div class="banner">
            <h3>ACCEPT / REJECT LOAN APPLICATIONS</h3>
        </div>
        <div class="table">
            <table id="myTable" class="styled-table">
                <thead>
                    <tr>
                        <th>LoanId</th>
                        <th>Account No</th>
                        <th>Name</th>
                        <th>Loan Amount</th>
                        <th>Loan Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_applications = mysqli_query($conn, "SELECT * FROM loanapp WHERE Status='NOT SANCTIONED' AND customerBranch='$ifsc'");
                    if (mysqli_num_rows($get_applications) > 0) {
                        while ($apps = $get_applications->fetch_assoc()) {
                            echo "<tr>
                            <td>" . $apps['LoanAccountNo'] . "</td>
                            <td>" . $apps['customerAccountNo'] . "</td>
                            <td>" . $apps['customerName'] . "</td>
                            <td>" . $apps['LoanAmount'] . "</td>
                            <td>" . strtoupper($apps['LoanType']) . "</td>
                            <td><form method='post'>
                            <input type='hidden' name='accountno' value='" . $apps['customerAccountNo'] . "'>
                            <input type='hidden' name='loanno' value='" . $apps['LoanAccountNo'] . "'>
                            <input type='hidden' name='loanamount' value='" . $apps['LoanAmount'] . "'>
                            <button name='accept'>Accept</button>
                            <button name='reject'>Reject</button>
                            </form>
                            </td>
                            </tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>
<?php
if (isset($_POST['accept'])) {
    include_once "functions.php";
    $accountno = $_POST['accountno'];
    $loanNo = $_POST['loanno'];
    $loanAmount = $_POST['loanamount'];
    loanApprove($loanNo, $loanAmount, $accountno);
    echo "<script>alert('Loan Sanctioned '); 
        window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    exit;
}
if (isset($_POST['reject'])) {
    include_once "functions.php";
    $loanNo = $_POST['loanno'];
    $accountno = $_POST['accountno'];
    loanReject($loanNo, $accountno);
    echo "<script>alert('Loan Rejected '); 
        window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    exit;
}
?>