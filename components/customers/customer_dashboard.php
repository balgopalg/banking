<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
    <style>
        #fd {
            display: none;
        }

        #loan {
            display: none;
        }
    </style>
</head>
<?php
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
$email = $_SESSION['email'];
$LastLogin = $_SESSION['LastLogin'];

date_default_timezone_set('Asia/Kolkata');
$currentLoginTimestamp = $_SESSION['currentLogin'];
$currentLogin = date('Y-m-d H:i:s', $currentLoginTimestamp);
mysqli_query($conn, "UPDATE `customers` SET `LastLogin`='$currentLogin' WHERE `Email` = '$email';");


$find_user = mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email';");
$row = mysqli_fetch_assoc($find_user);
$name = $row['FullName'];
$userName = $row['UserName'];
$accountNo = $row['AccountNo'];
$balance = $row['Balance'];
$img = $row['img'];
$ifsc = $row['IFSC'];

if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email'")) > 0) {
    $savingAccno = 1;
}
if (mysqli_num_rows($fd = mysqli_query($conn, "SELECT count(*) as count, SUM(Principal) as TotalInvestment, SUM(FinalAmount) as TotalReturn , SUM(current_value) as currentValue FROM fd WHERE customerAccountNo=$accountNo")) > 0) {
    $fdaccountno = mysqli_fetch_assoc($fd);
}
if (mysqli_num_rows($loan = mysqli_query($conn, "SELECT count(*) as count, SUM(LoanAmount) as totalLoanAmount, SUM(LoanDue) as totalLoanDue, SUM(LoanPaid) as totalLoanPaid FROM loanApp WHERE customerAccountNo=$accountNo")) > 0) {
    $loanaccountno = mysqli_fetch_assoc($loan);
}


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
    <main>
        <section class="hero">
            <div class="title">
                <div>
                    <h2 style="color: #97144D;">Dashboard</h2>
                    <p>IFSC: <?php echo $ifsc; ?></p>
                </div>
                <div>
                    <h3><?php echo strtoupper($name); ?></h3>
                    <p>Last login: <?php echo $LastLogin; ?></p>
                </div>
            </div>
            <div class="account-main">
                <div class="account-details">
                    <div class="accounts">
                        <div class="acc-balance">
                            <h4>Account Balance(<?php echo $savingAccno; ?> accounts)</h4>
                            <p>&#8377; <?php echo "$balance"; ?></p>
                        </div>
                        <div class="acc-no">
                            <p><?php echo "$accountNo"; ?></p>
                            <h4>&#8377; <?php echo "$balance"; ?></h4>
                        </div>
                        <div>
                            <i>View Account Details</i>
                            &nbsp;&nbsp;
                            <a href="account_summary.php"><i class="fa-solid fa-angles-right"></i></a>
                        </div>
                    </div>
                    <div class="accounts" id="fd">
                        <div class="acc-balance">
                            <h4>Total FD's(<?php echo $fdaccountno['count']; ?> FDs)</h4>
                            <p>&#8377; <?php echo $fdaccountno['currentValue']; ?></p>
                        </div>
                        <div class="acc-no">
                            <p>Total invested amount:</p>
                            <h4>&#8377; <?php echo $fdaccountno['TotalInvestment']; ?></h4>
                            <p>Total FD returns:</p>
                            <h4>&#8377; <?php echo $fdaccountno['TotalReturn']; ?></h4>
                        </div>
                        <div>
                            <i>Grow your money by investing in FDs</i>
                            &nbsp;&nbsp;
                            <a href="fd.php"><i class="fa-solid fa-angles-right"></i></a>
                        </div>
                    </div>
                    <div class="accounts" id='loan'>
                        <div class="acc-balance">
                            <h4>Total Loan's(<?php echo $loanaccountno['count']; ?> Loans)</h4>
                            <p>&#8377; <?php echo $loanaccountno['totalLoanAmount']; ?></p>
                        </div>
                        <div class="acc-no">
                            <p>Total payment done:</p>
                            <h4>&#8377; <?php echo $loanaccountno['totalLoanPaid']; ?></h4>
                            <p>Toal due:</p>
                            <h4>&#8377; <?php echo $loanaccountno['totalLoanDue']; ?></h4>
                        </div>
                        <div>
                            <i>Check Loans Details</i>
                            &nbsp;&nbsp;
                            <a href="applyLoan.php"><i class="fa-solid fa-angles-right"></i></a>
                        </div>
                    </div>
                    <div class="rm">
                        <div>
                            <h4>Relationship Manager</h4>
                        </div>
                        <i class="fa-solid fa-handshake-angle"></i>
                        <div class="btn">
                            <a href="raise_request.php">KNOW YOUR RM</a>
                        </div>
                    </div>
                </div>
                <div class="account-summary">
                    <div class="recent-payee">
                        <p class='gg'>
                            RECENT PAYEES
                        </p>
                        <div class="payee-area">
                            <form action="" method="post">
                                <?php
                                $get_payees = mysqli_query($conn, "SELECT * FROM payee WHERE customerAccNo=$accountNo ORDER BY `payee`.`LastTransactionDate` DESC");
                                if (mysqli_num_rows($get_payees) > 0) {
                                    while ($payeeInfo = mysqli_fetch_assoc($get_payees)) {
                                        echo '<div class="payee-details">
                                        <div class="payee-name">
                                            <h5>' . $payeeInfo['payeeName'] . '</h5>
                                            <div class="payee-bank">
                                                <p>' . $payeeInfo['payeeNickname'] . '</p>
                                                <p>' . $payeeInfo['payeeIFSC'] . '</p>
                                                <p>' . $payeeInfo['payeeAccountNo'] . '</p>
                                            </div>
                                        </div>
                                        <div class="payee-transactions">
                                            <p style="font-weight: 600;">Rs ' . $payeeInfo['LastTransactionAmount'] . '</p>
                                            <p>' . $payeeInfo['LastTransactionDate'] . '</p>
                                        </div>
                                    </div>';
                                    }
                                } else {
                                    echo "<h3>No Payee Information</h3>";
                                }
                                ?>
                            </form>
                            <!-- <div>
                                <input type="hidden" name="name" value="' . $payeeInfo['payeeName'] . '">
                                <input type="hidden" name="name" value="' . $payeeInfo['payeeAccountNo'] . '">
                                <input type="hidden" name="name" value="' . $payeeInfo['payeeIFSC'] . '">
                                <button name="recent-transfer-pay">Pay</button>
                            </div> -->
                        </div>
                    </div>
                    <div class="quick-transfer">
                        <h4>Quick Transfer</h4>

                        <h5 style="color:gray; font-weight:100;">*You can transfer up to INR 2 Lakhs using quick transfer. Fees may apply . Go To the main <a href="fund_transfer.php">Fund Transfer</a> section to tranfer high amounts</h5>

                        <h5>Enter a payee name or select a payee to transfer ASAP(Quick Transfer)</h5>
                        <form action="" method="post">
                            <div>Send &nbsp;<i class="fa-solid fa-indian-rupee-sign"></i> <input type="number" name="amount" id="amount" placeholder="Enter amount" required> To
                                <select name="payeeAccountNo" title="please select a payee" required>
                                    <?php
                                    $get_payees = mysqli_query($conn, "SELECT * FROM payee WHERE customerAccNo=$accountNo");
                                    while ($payeeInfos = mysqli_fetch_assoc($get_payees)) {
                                        echo '<option value="' . $payeeInfos['payeeAccountNo'] . '">' . $payeeInfos['payeeName'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <button name="quick-transfer-pay">PAY</button>
                        </form>
                        <h5><a href="fund_transfer.php#addpayee">Add Payee</a></h5>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <section class="">

    </section>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>


</body>

</html>

<?php


if ($fdaccountno['count'] > 0) {
    echo "<script>
    document.getElementById('fd').style.display = 'block';
</script>";
}
if ($loanaccountno['count'] > 0) {
    echo "<script>
    document.getElementById('loan').style.display = 'block';
</script>";
}


if (isset($_POST['quick-transfer-pay'])) {
    $amount = $_POST['amount'];
    if ($amount > 200000) {
        echo "<script>alert('Quick transaction limit is of 2 lakhs.');</script>";
    } else {
        if ($amount > $balance) {
            echo "<script>alert('Insufficient Balance');</script>";
        } else {
            $receiver_acountno = $_POST['payeeAccountNo'];
            $sender_accountno = $accountNo;
            include "functions.php";
            $now = date("Y-m-d H:i:s");
            updateTransaction($sender_accountno, $receiver_acountno, $amount, 'Quick Transfer');
            mysqli_query($conn, "UPDATE payee SET LastTransactionAmount=$amount, LastTransactionDate='$now' WHERE customerAccNo=$sender_accountno AND payeeAccountNo=$receiver_acountno");
        }
    }
}
?>