<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <link rel="stylesheet" href="style.css">
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

$get_fdDetails = mysqli_query($conn, "SELECT COUNT(*) as NoFD, SUM(Principal) as TotalFDAmount ,SUM(Interest) as TotalInterest, SUM(FinalAmount) as TotalFinalAmount FROM fd WHERE customerAccountNo=$accountNo");
$fd_data = mysqli_fetch_assoc($get_fdDetails);

$get_loanDetails = mysqli_query($conn, "SELECT COUNT(*) as NoLoan, SUM(LoanAmount) as TotalLoanAmount ,SUM(LoanPaid) as TotalLoanPaid, SUM(LoanDue) as TotalLoanDue FROM loanapp WHERE customerAccountNo=$accountNo AND (Status='SANCTIONED' OR Status='PARTIAL PAYMENT DONE')");
$loan_data = mysqli_fetch_assoc($get_loanDetails);

$get_transactions = mysqli_query($conn, "SELECT SUM(TransactionAmount) as totalTransaction
FROM Transactions 
WHERE (Actions != 'deposit' 
AND Actions != 'withdraw' 
AND Actions != 'loan_sanctioned' 
AND Actions != 'fd_breaked'
AND Actions != 'int._credited') 
AND (Sender = $accountNo OR Receiver = $accountNo)");
$transaction_data = mysqli_fetch_assoc($get_transactions);
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
        <div class="accounts-main">
            <div class="account-window">
                <div class="title">
                    <div>
                        <h3>Saving Account Details</h3>
                    </div>
                    <div>
                        <h4>Account no : <?php echo $accountNo ?></h4>
                    </div>
                </div>
                <div class="content">
                    <div class="box">
                        <h4>
                            Total Balance:
                        </h4>
                        <p>
                            Rs <?php echo $balance ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Total Transactions Done:
                        </h4>
                        <p>
                            Rs <?php echo $transaction_data['totalTransaction'] ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Account Opening Date:
                        </h4>
                        <p>
                            <?php echo $row['DateOfOpening'] ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="account-window">
                <div class="title">
                    <div>
                        <h3>Fixed Deposite Details</h3>
                    </div>
                    <div>

                    </div>
                </div>
                <div class="content">
                    <div class="box">
                        <h4>
                            No. of FDs:
                        </h4>
                        <p>
                            <?php echo $fd_data['NoFD']; ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Total FD Amount:
                        </h4>
                        <p>
                            Rs <?php echo $fd_data['TotalFDAmount']; ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Total FD interest:
                        </h4>
                        <p>
                            Rs <?php echo $fd_data['TotalInterest']; ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Total FD Returns:
                        </h4>
                        <p>
                            Rs <?php echo $fd_data['TotalFinalAmount']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="account-window">
                <div class="title">
                    <div>
                        <h3>Loan Details</h3>
                    </div>
                    <div>

                    </div>
                </div>
                <div class="content">
                    <div class="box">
                        <h4>
                            No. of Loans:
                        </h4>
                        <p>
                            <?php echo $loan_data['NoLoan']; ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Total Loan Amount:
                        </h4>
                        <p>
                            Rs <?php echo $loan_data['TotalLoanAmount']; ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Total Loan Paid:
                        </h4>
                        <p>
                            Rs <?php echo $loan_data['TotalLoanPaid']; ?>
                        </p>
                    </div>
                    <div class="box">
                        <h4>
                            Total Loan Due:
                        </h4>
                        <p>
                            Rs <?php echo $loan_data['TotalLoanDue']; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>