<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <?php
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    session_start();
    if ($_SESSION["isLoggedin"] == false) {
        header('location:/index.php');
    }
    $email = $_SESSION['email'];
    $get_employee = mysqli_query($conn, "SELECT * FROM employees,branch WHERE employees.EmployeeEmail = '$email'");
    $emp = mysqli_fetch_assoc($get_employee);

    if (isset($_POST['search-account'])) {
        $accountno = $_POST['accountno'];
        $_SESSION['customerAccountNo'] = $accountno;
        $sql = mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo=$accountno;");
        $row = mysqli_fetch_assoc($sql);
        $transaction_Details = mysqli_query($conn, "SELECT * FROM transactions WHERE Sender=$accountno OR Receiver=$accountno");
    } else {
        $accountno = $_SESSION['customerAccountNo'];
        $sql = mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo=$accountno;");
        $row = mysqli_fetch_assoc($sql);
        $transaction_Details = mysqli_query($conn, "SELECT * FROM transactions WHERE Sender=$accountno OR Receiver=$accountno");
    }
    ?>
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
                    BRANCH : <?php echo  $row['IFSC']; ?>
                </div>
                Welcome 👋 <?php echo strtoupper($emp['EmployeeName']); ?>
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
        <div>
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
    <main class="profile-main">
        <section class="profile-gg">
            <div class="pic">
                <div style="flex-direction: column;">
                    <img src="/images/<?php echo $row['img']; ?>" class="profile-pic" alt="">
                    <h6 style="text-align: center; margin:20px;">Status : <?php echo $row['Status'] ?></h6>
                </div>
                <div class="gg">
                    <form action="update_details.php" method="post" style="flex-direction:row;">
                        <h5>Change Status :</h5>
                        <input type="submit" id="btn" value="Mark Active" name="active">
                        <input type="submit" id="btn" value="Mark Inactive" name="inactive">
                    </form>
                    <form action="update_details.php" method="post">
                        <input type="password" name="password" id="password" placeholder="Create a Password" required>
                        <input type="submit" id="btn" value="Update password" name="changepass">
                    </form>
                    <form action="update_details.php" method="post" enctype="multipart/form-data">
                        <div class="field image">
                            <label>Select Image</label>
                            <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                        </div>
                        <input type="submit" id="btn" value="Update photo" name="updatepic">
                    </form>
                    <form action="update_details.php" method="post">
                        <input type="submit" id="btn" value="Delete Account" name="deleteAccount">
                    </form>
                </div>
            </div>
            <div class="wrapper">
                <section class="form signup">
                    <header>Profile</header>
                    <form action="update_details.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <input type="number" name="accountno" value="<?php echo $row['AccountNo']; ?>" hidden>
                        <div class="error-text"></div>
                        <div class="field input">
                            <label>IFSC</label>
                            <input type="text" name="ifsc" placeholder="<?php echo $row['IFSC'] ?>" value="<?php echo $row['IFSC'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Fullname</label>
                            <input type="text" name="fname" placeholder="<?php echo $row['FullName'] ?>" value="<?php echo $row['FullName'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Username</label>
                            <input type="text" name="uname" placeholder="<?php echo $row['UserName'] ?>" value="<?php echo $row['UserName'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Email Address</label>
                            <input type="text" name="email" placeholder="<?php echo $row['Email'] ?>" value="<?php echo $row['Email'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Phone no</label>
                            <input type="text" name="phoneno" placeholder="<?php echo $row['PhoneNo'] ?>" value="<?php echo $row['PhoneNo'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Gender</label>
                            <input type="text" name="gender" placeholder="<?php echo $row['gender'] ?>" value="<?php echo strtoupper($row['gender']) ?>" required>
                        </div>
                        <div class="field input">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="<?php echo $row['Address'] ?>" value="<?php echo $row['Address'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>District</label>
                            <input type="text" name="district" placeholder="<?php echo $row['District'] ?>" value="<?php echo $row['District'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>State</label>
                            <input type="text" name="state" placeholder="<?php echo $row['State'] ?>" value="<?php echo $row['State'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Pincode</label>
                            <input type="text" name="pincode" placeholder="<?php echo $row['Pincode'] ?>" value="<?php echo $row['Pincode'] ?>" required>
                        </div>
                        <div class="field input">
                            <label>Aadhaar No</label>
                            <input type="text" name="aadhaar" placeholder="<?php echo $row['AadhaarNo'] ?>" value="<?php echo $row['AadhaarNo'] ?>" required>
                        </div>
                        <div class="field button">
                            <input type="submit" id="btn" name="submit" value="Update">
                        </div>
                    </form>
                </section>
            </div>
        </section>
        <style>
            .transactions {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 30px;
                min-height: 300px;
                gap: 25px;
            }

            .dataTables_filter {
                margin-bottom: 15px;
            }
        </style>
        <section class="transactions">
            <h3>TRANSACTIONS</h3>
            <br>
            <table id="myTable" class="styled-table">
                <thead>
                    <tr>
                        <th>Transaction Date</th>
                        <th>Description</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Balance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($fetch_transactions = mysqli_fetch_assoc($transaction_Details)) {
                        $tdate = $fetch_transactions['TransactionDate'];
                        $tamount = $fetch_transactions['TransactionAmount'];
                        $sender = $fetch_transactions['Sender'];
                        $receiver = $fetch_transactions['Receiver'];
                        $actions = $fetch_transactions['Actions'];
                        $remark=$fetch_transactions['Remark'];
                        if ($accountno == $receiver) {
                            if ($actions == 'loan_sanctioned') {
                                $debit = 0;
                                $credit = $tamount;
                                $balance = $fetch_transactions['ReceiverBalance'];
                                $description = "LOAN SANCTIONED/CR/" . $fetch_transactions['Receiver'];
                            } else if ($actions == 'fd_breaked') {
                                $debit = 0;
                                $credit = $tamount;
                                $balance = $fetch_transactions['ReceiverBalance'];
                                $description = "FD BREAKED/CR/" . $fetch_transactions['Receiver'];
                            } else if ($actions == 'int._credited') {
                                $debit = 0;
                                $credit = $tamount;
                                $balance = $fetch_transactions['ReceiverBalance'];
                                $description = "INT. /CR/" . $fetch_transactions['Receiver'];
                            } else if ($actions == 'deposit') {
                                $debit = 0;
                                $credit = $tamount;
                                $balance = $fetch_transactions['ReceiverBalance'];
                                $description = "SELF/DEPOSIT/CR/" . $fetch_transactions['Receiver'];
                            } else {
                                $debit = 0;
                                $credit = $tamount;
                                $balance = $fetch_transactions['ReceiverBalance'];
                                $description = "P2A/E TRANSFER/CR/" . $fetch_transactions['Sender'] . "/" . $remark;
                            }
                        } else {
                            if ($actions == 'fd_booked') {
                                $credit = 0;
                                $debit = $tamount;
                                $balance = $fetch_transactions['SenderBalance'];
                                $description = "FD BOOKED/DR/" . $fetch_transactions['Sender'];
                            } else if ($actions == 'loan_due_paid') {
                                $credit = 0;
                                $debit = $tamount;
                                $balance = $fetch_transactions['SenderBalance'];
                                $description = "LOAN PAYMENT/DR/" . $fetch_transactions['Sender'];
                            } else if ($actions == 'withdraw') {
                                $credit = 0;
                                $debit = $tamount;
                                $balance = $fetch_transactions['SenderBalance'];
                                $description = "SELF/WITHDRAWAL/DR/" . $fetch_transactions['Sender'];
                            } else {
                                $credit = 0;
                                $debit = $tamount;
                                $balance = $fetch_transactions['SenderBalance'];
                                $description = "P2A/E TRANSFER/DR/" . $fetch_transactions['Receiver'] . "/" . $remark;
                            }
                        }
                        echo "
                <tr>
                <td>" . substr($tdate, 0, 10) . "</td>
                <td>" . $description . "</td>
                <td>" . $debit . "</td>
                <td>" . $credit . "</td>
                <td>" . $balance . "</td>
                </tr>
                ";
                    } ?>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>