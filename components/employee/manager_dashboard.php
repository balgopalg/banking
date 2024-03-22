<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

    <?php
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    session_start();
    if ($_SESSION["isLoggedin"] == false) {
        header('location:/index.php');
    }
    $email = $_SESSION['email'];
    $get_employee = mysqli_query($conn, "SELECT * FROM employees,branch WHERE employees.EmployeeEmail = '$email' AND employees.EmployeeBranch=branch.ID");
    $row = mysqli_fetch_assoc($get_employee);
    $ifsc = $row['IFSC'];
    $_SESSION['ifsc'] = $ifsc;
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</head>

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
    </style>
    <main>
        <div class="banner">
            <h3>SEARCH LOAN ACCOUNTS</h3>
        </div>
        <div class="table">
            <table id="myTable" class="styled-table">
                <thead>
                    <tr>
                        <th>Aadhaar no</th>
                        <th>LoanNo</th>
                        <th>Account No</th>
                        <th>Loan Amount</th>
                        <th>Loan Due</th>
                        <th>Phone No</th>
                        <th>Email</th>
                        <th>Loan type</th>
                        <th>Sanction Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_loan_details = mysqli_query($conn, "SELECT * FROM customers INNER JOIN loanapp ON customers.AccountNo = loanapp.customerAccountNo WHERE loanapp.customerBranch='$ifsc'");
                    if (mysqli_num_rows($get_loan_details) > 0) {
                        while ($row = $get_loan_details->fetch_assoc()) {
                            echo "<tr>
                            <td>" . $row['AadhaarNo'] . "</td>
                            <td>" . $row['LoanAccountNo'] . "</td>
                            <td>" . $row['customerAccountNo'] . "</td>
                            <td>" . $row['LoanAmount'] . "</td>
                            <td>" . $row['LoanDue'] . "</td>
                            <td>" . $row['PhoneNo'] . "</td>
                            <td>" . $row['Email'] . "</td>
                            <td>" . strtoupper($row['LoanType']) . "</td>
                            <td>" . $row['SanctionDate'] . "</td>
                            <td>" . $row['Status'] . "</td>
                            <td>
                            <form method='post' action=''>
                                <input type='hidden' name='loanno' value='" . $row['LoanAccountNo'] . "'>
                                <button type='submit' name='delete'>Delete</button>
                            </form>
                            </td>
                            </tr>";
                        }
                    } else {
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

if (isset($_POST['delete'])) {
    $loanno = $_POST['loanno'];
    $loandata = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM loanapp WHERE LoanAccountNo='$loanno'"));
    if ($loandata['Status'] == 'FULLY PAID' || $loandata['LoanDue'] == 0) {
        if (mysqli_query($conn, "DELETE FROM loanapp WHERE LoanAccountNo=$loanno")) {
            echo "<script>alert('$loanno - is now closed');  window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
    } else {
        echo "<script>alert('Customer not paid his dues , cannot delete')</script>";
    }
}
?>