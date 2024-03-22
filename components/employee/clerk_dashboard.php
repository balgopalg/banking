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
require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
$email = $_SESSION['email'];
$get_employee = mysqli_query($conn, "SELECT * FROM employees,branch WHERE employees.EmployeeEmail = '$email' AND employees.EmployeeBranch=branch.ID");
$row = mysqli_fetch_assoc($get_employee);
$_SESSION['ifsc'] = $row['IFSC'];
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
                    BRANCH : <?php echo  $ifsc ?>
                </div>
                Welcome 👋 <?php echo strtoupper($row['EmployeeName']); ?>
                <div class="dropdown">
                    <img src="/images/clerk.jpg" alt="">
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
                <li><a href="clerk_dashboard.php">Search Accounts</a></li>
                <li><a href="approveApp.php">Approve Application</a></li>
                <li><a href="fund_transfer.php">Fund Transfer</a></li>
                <li><a href="deposit_withdraw.php">Deposit/Withdraw</a></li>
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
            <h3>SEARCH ACCOUNTS</h3>
        </div>
        <div class="table">
            <table id="myTable" class="styled-table">
                <thead>
                    <tr>
                        <th>Aadhaar no</th>
                        <th>CRN</th>
                        <th>Account No</th>
                        <th>IFSC Code</th>
                        <th>FullName</th>
                        <th>Balance</th>
                        <th>Phoneno</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM customers WHERE IFSC='$ifsc'");
                    while ($udata = $result->fetch_assoc()) {
                        echo "<tr>
                    <td>" . $udata['AadhaarNo'] . "</td>
                    <td>" . $udata['CRN'] . "</td>
                    <td>" . $udata['AccountNo'] . "</td>
                    <td>" . $udata['IFSC'] . "</td>
                    <td>" . $udata['FullName'] . "</td>
                    <td>" . $udata['Balance'] . "</td>
                    <td>" . $udata['PhoneNo'] . "</td>
                    <td>" . $udata['Email'] . "</td>
                    <td>" . $udata['Status'] . "</td>
                    <td>
                        <form method='post' action='account_profile.php'>
                            <input type='hidden' name='accountno' value='" . $udata['AccountNo'] . "'>
                            <button name='search-account'>view</button>
                        </form>
                    </td>
                </tr>";
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