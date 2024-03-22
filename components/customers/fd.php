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
                    $get_fd = mysqli_query($conn, "SELECT * FROM fd WHERE customerAccountNo='" . $row["AccountNo"] . "'");
                    if (mysqli_num_rows($get_fd) > 0) {
                        while ($fd_data = mysqli_fetch_assoc($get_fd)) {
                            echo '
                    <div class="box">
                    <div class="sub">
                        <h4>FD no. <span>' . $fd_data["FDAccountNo"] . '</span></h4>
                        <h4>Principal <span>' . $fd_data["Principal"] . '</span></h4>
                        <h4>Tanure <span>' . $fd_data["Tanure"] . '</span></h4>
                        <h4>Rate of Interest<span>' . $fd_data["InterestRate"] . '</span></h4>
                    </div>
                    <div class="sub">
                        <h4>Interest <span>' . $fd_data["Interest"] . '</span></h4>
                        <h4>FinalAmount <span>' . $fd_data["FinalAmount"] . '</span></h4>
                        <h4>FD Open Date<span>' . $fd_data["FDOpeningDate"] . '</span></h4>
                        <h4> FD Maturity on<span>' . $fd_data["FDBreakDate"] . '</span></h4>
                    </div>
                    <div class="sub">
                        <h4>Status<span>' . $fd_data["Status"] . '</span></h4>
                        <h4>Current value<span>' . $fd_data["current_value"] . '</span></h4>
                        <input type="number" name="fdNo" value="' . $fd_data["FDAccountNo"] . '" hidden></input>
                        <input type="number" name="fdAmount" value="' . $fd_data["current_value"] . '" hidden></input>
                        <h4><button name="breakFD">Break FD</button></h4>
                    </div>
                    </div> 
                ';
                        }
                    } else {
                        echo "<h4 align='center'>No FD Booked yet<h4>";
                    }
                    ?>
                </form>
            </div>
        </div>
        <div class="wrapper">
            <section class="form signup">
                <header>Open an FD<span>Available balance : <?php echo $row['Balance']; ?></span></header>
                <form action="fd.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="field input">
                        <label>Amount</label>
                        <input type="text" name="amount" placeholder="Enter Amount" required>
                    </div>
                    <div class="field input">
                        <label>Tanure :</label>
                        <input type="number" name="tanure" placeholder="Enter in months" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter Password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <script src="/assets/javascript/pass-show-hide.js"></script>
                    <div class="field button">
                        <input type="submit" name="submit" value="Book FD">
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
    if (isset($_POST['submit'])) {
        if ($_POST['amount'] > $row['Balance'] || md5($_POST['password']) != $row['Password']) {
            echo "<script>alert('FD Failed ( Wrong password / Insufficient Balance )'); </script>";
        } else {
            include "functions.php";
            $principal = $_POST['amount'];
            $tanure = $_POST['tanure'];
            $currentDateTime = new DateTime();
            $endDate = clone $currentDateTime;
            $endDate->modify('+' . $tanure . ' months');
            $interval = $currentDateTime->diff($endDate);
            $days = $interval->format('%a');
            $pass = $_POST['password'];
            $result = calculateInterest($principal, $days, $tanure);
            fdCreate($row["AccountNo"], $principal, $currentDateTime, $tanure, $endDate, $result["interestRate"], $result['interest'], $result["totalAmount"], $balance);
            echo "<script>alert('FD Booked'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
    }
}
if (isset($_POST['breakFD'])) {
    include_once "functions.php";
    $fdNo = $_POST['fdNo'];
    $fdAmount = $_POST['fdAmount'];
    fdBreak($row['AccountNo'], $fdNo, $row['Balance'], $fdAmount);
    echo "<script>alert('FD Breaked'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
}

?>