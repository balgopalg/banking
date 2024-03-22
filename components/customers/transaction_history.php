<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">

    <?php
    session_start();
    if ($_SESSION["isLoggedin"] == false) {
        header('location:/index.php');
    }
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    $email = $_SESSION['email'];
    $find_user = mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email';");
    $row = mysqli_fetch_assoc($find_user);
    $name = $row['FullName'];
    $userName = $row['UserName'];
    $accountNo = $row['AccountNo'];
    $balance = $row['Balance'];
    $img = $row['img'];
    $transaction_Details = mysqli_query($conn, "SELECT * FROM transactions WHERE Sender=$accountNo OR Receiver=$accountNo");
    ?>
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
                Welcome <?php echo "$userName"; ?>
                <div class="dropdown">
                    <img src="/images/<?php echo "$img"; ?>" class="users" alt="">
                    <div class="items">
                        <a href="profile.php">Profile</a>
                        <a href="/assets/php/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="bottom-nav">
        <div class="s1">
            <ul>
                <li><a href="customer_dashboard.php">Dashboard</a></li>
                <li><a href="account_summary.php">Account Summary</a></li>
                <li><a href="transaction_history.php">Transactions History</a></li>
                <li><a href="fund_transfer.php">Fund Transfer / Modify payee</a></li>
                <li><a href="raise_request.php">Raise a request</a></li>
                <li><a href="applyLoan.php">Apply for Loan</a></li>
                <li><a href="fd.php">Investments</a></li>
            </ul>
        </div>
        <div>
            <div class="tooltip">
                <a href=""> <button>
                        <i class="fa-solid fa-arrows-rotate"></i>
                    </button>
                </a>
            </div>
            <div class="tooltip">
                <a href="notifications.php">
                    <button>
                        <i class="fa-solid fa-question"></i>
                    </button>
                </a>
                <span class="tooltiptext">Notifications</span>
            </div>
            <div class="tooltip">
                <a href="/components/extra/faqs.php">
                    <button>
                        <i class="fa-solid fa-book"></i>
                    </button>
                </a>
                <span class="tooltiptext">FAQs</span>
            </div>

        </div>
    </div>
    <main class="account-summary-main">
        <div class="tran-account-details">
            <div class="profile-info">
                <div class="demographic">
                    <h4><?php echo strtoupper($row['FullName']); ?></h4>
                    <p><?php echo strtoupper($row['Address']); ?> </p>
                    <p><?php echo strtoupper($row['District']); ?> </p>
                    <p><?php echo strtoupper($row['State']); ?> </p>
                    <p><?php echo strtoupper($row['Pincode']); ?> </p>
                </div>
                <div class="contact">
                    <p>Registered Mobile No : <?php echo $row['PhoneNo']; ?> </p>
                    <p>Registered Email ID :<?php echo strtoupper($row['Email']); ?> </p>
                    <p> Scheme : Savings Account </p>
                </div>
            </div>
            <div class="banking-info">
                <div class="print">
                    <button id='printPage'>Print</button>
                </div>
                <p>Account No:<?php echo $row['AccountNo']; ?></p>
                <p>Customer ID:<?php echo $row['CRN']; ?></p>
                <p>IFSC: <?php echo $row['IFSC']; ?></p>
                <p>Aadhaar No:<?php echo $row['AadhaarNo']; ?></p>
                <p>Nomineee Name: N/a</p>
            </div>
        </div>
        <script>
            var prntBtn = document.getElementById('printPage');
            prntBtn.addEventListener('click', function() {
                var table = document.getElementsByClassName('summary-table')[0];
                table.style.height = '100%';
                table.style.scale = '0.9';
                window.print();
            });
        </script>
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

            table.dataTable tbody th,
            table.dataTable tbody td {
                padding: 8px 10px;
                font-size: 12px;
            }
        </style>

        <div class="summary-main">
            <div class="summary-table">
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
                            $senderBal = $fetch_transactions['SenderBalance'];
                            $receiverBal = $fetch_transactions['ReceiverBalance'];
                            $receiver = $fetch_transactions['Receiver'];
                            $actions = $fetch_transactions['Actions'];
                            $remark = $fetch_transactions['Remark'];
                            if ($accountNo == $receiver) {
                                if ($actions == 'loan_sanctioned') {
                                    $debit = 0;
                                    $credit = $tamount;
                                    $balance = $receiverBal;
                                    $description = "LOAN SANCTIONED/CR/" . $remark;
                                } else if ($actions == 'fd_breaked') {
                                    $debit = 0;
                                    $credit = $tamount;
                                    $balance = $receiverBal;
                                    $description = "FD BREAKED/CR/" . $remark;
                                } else if ($actions == 'int._credited') {
                                    $debit = 0;
                                    $credit = $tamount;
                                    $balance = $receiverBal;
                                    $description = "INT. /CR/" . $receiver;
                                } else if ($actions == 'deposit') {
                                    $debit = 0;
                                    $credit = $tamount;
                                    $balance = $receiverBal;
                                    $description = "SELF/DEPOSIT/CR/" . $receiver;
                                } else {
                                    $debit = 0;
                                    $credit = $tamount;
                                    $balance = $receiverBal;
                                    $description = "P2A/E TRANSFER/CR/" . $sender . "/" . $remark;
                                }
                            } else {
                                if ($actions == 'fd_booked') {
                                    $credit = 0;
                                    $debit = $tamount;
                                    $balance = $senderBal;
                                    $description = "FD BOOKED/DR/" . $remark;
                                } else if ($actions == 'loan_due_paid') {
                                    $credit = 0;
                                    $debit = $tamount;
                                    $balance = $senderBal;
                                    $description = "LOAN PAYMENT/DR/" . $remark;
                                } else if ($actions == 'withdraw') {
                                    $credit = 0;
                                    $debit = $tamount;
                                    $balance = $senderBal;
                                    $description = "SELF/WITHDRAWAL/DR/" . $sender;
                                } else {
                                    $credit = 0;
                                    $debit = $tamount;
                                    $balance = $senderBal;
                                    $description = "P2A/E TRANSFER/DR/" . $receiver . "/" . $remark;
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
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>