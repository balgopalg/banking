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
                    BRANCH : <?php echo  $row['IFSC']; ?>
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
    <main class="fund-transfer-main">
        <div class="wrapper">
            <section class="form signup">
                <header>Transfer Fund</header>
                <form action="fund_transfer.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="field input">
                        <label>Sender's account no</label>
                        <input type="number" name="sendersAccountNo" placeholder="Enter Sender's account no" required>
                    </div>

                    <div class="field input">
                        <label>Receiver's account no</label>
                        <input type="number" name="receiversAccountNo" placeholder="Enter Receiver's account no" required>
                    </div>
                    <div class="field input">
                        <label>IFS Code</label>
                        <input type="text" name="ifsc" placeholder="Enter Receiver's IFSC" required>
                    </div>
                    <div class="field input">
                        <label>Amount</label>
                        <input type="number" name="amount" placeholder="Enter Amount" required>
                    </div>
                    <div class="field input">
                        <label>Remark</label>
                        <input type="text" name="remark" placeholder="Remark" required>
                    </div>
                    <div>
                        <input type="checkbox" name="mandate" value="yes"> Mandate Received From Sender
                    </div>
                    <div class="field button">
                        <input type="submit" name="submit" value="Make transaction">
                    </div>
                </form>
            </section>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $sendersAccountNo = $_POST['sendersAccountNo'];
    $receiversAccountNo = $_POST['receiversAccountNo'];
    $receiverIfsc = strtoupper($_POST['ifsc']);
    $amount = $_POST['amount'];
    $remark = $_POST['remark'];
    if (isset($_POST['mandate'])) {
        $sender = mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo=$sendersAccountNo");
        if (mysqli_num_rows($sender) > 0) {
            $receiver = mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo=$receiversAccountNo AND IFSC='$receiverIfsc';");
            if (mysqli_num_rows($receiver) > 0) {
                include_once "functions.php";
                $receiver_d = mysqli_fetch_assoc($receiver);
                $sender_d = mysqli_fetch_assoc($sender);
                $senderBalance = $sender_d['Balance'];
                if ($senderBalance < $amount) {
                    echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Insufficient Balance !!! Rs. $senderBalance';
        err.style.display='block';
        </script>";
                } else {
                    $receiverBalance = $receiver_d['Balance'];
                    fundTransfer($sendersAccountNo, $receiversAccountNo, $senderBalance, $receiverBalance, $amount, $remark);
                    echo "<script>alert('Transaction Successful'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
                }
            } else {
                echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Invalid receivers account details';
        err.style.display='block';
        </script>";
            }
        } else {
            echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Sender does not exist';
        err.style.display='block';
        </script>";
        }
    } else {
        echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Mandate must be yes';
        err.style.display='block';
        </script>";
    }
}
?>