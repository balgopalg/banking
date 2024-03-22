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
    // $find_user = mysqli_query($conn, "SELECT * FROM customers INNER JOIN branch ON branch.IFSC = customers.IFSC WHERE customers.Email='$email'");

    $row = mysqli_fetch_assoc($find_user);
    $name = $row['FullName'];
    $userName = $row['UserName'];
    $accountNo = $row['AccountNo'];
    $balance = $row['Balance'];
    $img = $row['img'];
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
    <main class="fd-main">
        <div class="dd">
            <div class="existing-fd">
                <form method="post">
                    <?php
                    $get_loan = mysqli_query($conn, "SELECT * FROM loanApp WHERE customerAccountNo='" . $row["AccountNo"] . "'");
                    if (mysqli_num_rows($get_loan) > 0) {
                        while ($loan_data = mysqli_fetch_assoc($get_loan)) {
                            echo '
                    <div class="box">
                        <div class="sub">
                            <h4>Loan No.: <span>' . $loan_data["LoanAccountNo"] . '</span></h4>
                            <h4>Loan Type:<span>' . strtoupper($loan_data["LoanType"]) . '</span></h4>
                        </div>
                        <div class="sub">
                            <h4>Loan Amount <span>' . $loan_data["LoanAmount"] . '</span></h4>
                            <h4>Loan Paid <span>' . $loan_data["LoanPaid"] . '</span></h4>
                            <h4>Due Amount <span>' . $loan_data["LoanDue"] . '</span></h4>
                        </div>
                        <div class="sub">
                            <h4>Status<span>' . $loan_data["Status"] . '</span></h4>
                        </div>
                    </div> ';
                        }
                    } else {
                        echo "<h4 align='center'>No Loans Yet<h4>";
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="wrapper">
            <section class="form signup">
                <header>Apply For Loan</header>
                <form action="applyLoan.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="field input">
                        <label>Amount</label>
                        <input type="number" name="amount" placeholder="Enter Amount" required>
                    </div>
                    <div class="field input">
                        <label>Loan type:</label>
                        <select name="loanType" id="loanType">
                            <option value="personal">Personal Loan</option>
                            <option value="car">Car Loan</option>
                            <option value="home">Home Loan</option>
                            <option value="study">Study Loan</option>
                            <option value="business">Business Loan</option>
                        </select>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" name="submit" value="Apply For Loan">
                    </div>
                </form>
            </section>
        </div>
    </main>
    <section class="loanpayments">
        <div class="title">
            <img src="https://img.freepik.com/free-vector/banking-industry-concept-illustration_114360-13934.jpg?size=626&ext=jpg" alt="">
            <h3>Pay your dues on time</h3>
        </div>
        <div class="wrapper">
            <section class="form signup">
                <header>Pay your Loan dues </header>
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="field input">
                        <label for="loanAccno">Loan Account no - Due Amount</label>
                        <?php
                        $get_laonApp = mysqli_query($conn, "SELECT * FROM loanApp where customerAccountNo=$accountNo AND LoanDue > 0");
                        ?>
                        <select name="loanAccno" required>
                            <?php
                            while ($data = mysqli_fetch_assoc($get_laonApp)) {
                                echo "<option value='" . $data['LoanAccountNo'] . "'>" . $data['LoanAccountNo'] . " - " . $data['LoanDue'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="field input">
                        <label>Wish to pay</label>
                        <input type="number" name="payamount" placeholder="Enter Amount" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <script src="/assets/javascript/pass-show-hide.js"></script>
                    <div class="field button">
                        <input type="submit" name="pay" value="Pay">
                    </div>
                </form>
            </section>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    if (md5($_POST['password']) == $row['Password']) {
        $accountNo = $row['AccountNo'];
        $ifsc = $row['IFSC'];
        $name = $row['FullName'];
        $amount = $_POST['amount'];
        $loanType = $_POST['loanType'];
        include_once "functions.php";
        echo $ifsc;
        applyLoan($accountNo, $amount, $loanType, $ifsc, $name);
    } else {
        echo "<script>alert('Incorrect Password')</script>";
    }
}
if (isset($_POST['pay'])) {
    if (md5($_POST['password']) == $row['Password']) {
        $loanNo = $_POST['loanAccno'];
        $payamount = $_POST['payamount'];
        include_once "functions.php";
        if ($payamount > $balance) {
            echo "<script>alert('Insufficient Balance')</script>";
        } else {
            paydue($accountNo, $loanNo, $payamount);
        }
    } else {
        echo "<script>alert('Incorrect Password')</script>";
    }
}
?>