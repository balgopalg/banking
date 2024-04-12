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
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    if ($_SESSION["isLoggedin"] == false) {
        header('location:/index.php');
    }
    $email = $_SESSION['email'];
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    $find_user = mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email';");
    $row = mysqli_fetch_assoc($find_user);
    $name = $row['FullName'];
    $userName = $row['UserName'];
    $accountNo = $row['AccountNo'];
    $balance = $row['Balance'];
    $img = $row['img']; ?>
    <script>

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
                <a href="notifications.php?accountno=2&all=">
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
    <div class="banner">
        <h2>Notifications</h2>
    </div>
    <div class="notification-container">
        <div class="result">
            <div class="notification-section">
                <div class="title">
                    <?php
                    $notification_selected = false;

                    if (isset($_POST['all'])) {
                        echo "<h3>All Notifications</h3>";
                        $notification_selected = true;
                    }
                    if (isset($_POST['transactions'])) {
                        echo "<h3>Transactions Notifications</h3>";
                        $notification_selected = true;
                    }
                    if (isset($_POST['loans'])) {
                        echo "<h3>Loan Notifications</h3>";
                        $notification_selected = true;
                    }
                    if (isset($_POST['investments'])) {
                        echo "<h3>Investment Notifications</h3>";
                        $notification_selected = true;
                    }
                    if (isset($_POST['others'])) {
                        echo "<h3>Other Notifications</h3>";
                        $notification_selected = true;
                    }
                    if (!$notification_selected) {
                        echo "<h3>All Notifications</h3>";
                    }
                    ?>
                </div>
                <div class="notification-window">
                    <?php
                    $notification_selected = false;
                    if (isset($_POST['all'])) {
                        $notification_selected = true;
                        $get_allnotification = mysqli_query($conn, "SELECT * FROM notifications WHERE AccountNo=$accountNo");
                        if (mysqli_num_rows($get_allnotification) > 0) {
                            while ($retriveNoti = mysqli_fetch_assoc($get_allnotification)) {
                                if ($retriveNoti['Actions'] == 'debit') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'credit') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanSanctioned') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanRejected') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'FDCreated') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'FDBreaked') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'other') {
                                    echo "<p class='blueNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanPaid') {
                                    echo "<p class='blueNoti'>".$retriveNoti['Time']." - " . $retriveNoti['Message'] . "</p>";
                                }
                            }
                        }
                    }
                    if (isset($_POST['transactions'])) {
                        $notification_selected = true;
                        $get_allnotification = mysqli_query($conn, "SELECT * FROM notifications WHERE AccountNo=$accountNo AND (Actions='credit' OR Actions='debit')");
                        if (mysqli_num_rows($get_allnotification) > 0) {
                            while ($retriveNoti = mysqli_fetch_assoc($get_allnotification)) {
                                if ($retriveNoti['Actions'] == 'debit') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'credit') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                            }
                        }
                    }
                    if (isset($_POST['loans'])) {
                        $notification_selected = true;
                        $get_allnotification = mysqli_query($conn, "SELECT * FROM notifications WHERE AccountNo=$accountNo AND (Actions='loanSanctioned' OR Actions='loanRejected' OR Actions='loanPaid')");
                        if (mysqli_num_rows($get_allnotification) > 0) {
                            while ($retriveNoti = mysqli_fetch_assoc($get_allnotification)) {
                                if ($retriveNoti['Actions'] == 'loanSanctioned') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanRejected') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanPaid') {
                                    echo "<p class='blueNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                            }
                        }
                    }
                    if (isset($_POST['investments'])) {
                        $notification_selected = true;
                        $get_allnotification = mysqli_query($conn, "SELECT * FROM notifications WHERE AccountNo=$accountNo AND (Actions='FDCreated' OR Actions='FDBreaked')");
                        if (mysqli_num_rows($get_allnotification) > 0) {
                            while ($retriveNoti = mysqli_fetch_assoc($get_allnotification)) {
                                if ($retriveNoti['Actions'] == 'FDCreated') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'FDBreaked') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                            }
                        }
                    }
                    if (isset($_POST['others'])) {
                        $notification_selected = true;
                        $get_allnotification = mysqli_query($conn, "SELECT * FROM notifications WHERE AccountNo=$accountNo AND Actions='other';");
                        if (mysqli_num_rows($get_allnotification) > 0) {
                            while ($retriveNoti = mysqli_fetch_assoc($get_allnotification)) {
                                echo "<p class='blueNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                            }
                        }
                    }
                    if(!$notification_selected){
                        $get_allnotification = mysqli_query($conn, "SELECT * FROM notifications WHERE AccountNo=$accountNo");
                        if (mysqli_num_rows($get_allnotification) > 0) {
                            while ($retriveNoti = mysqli_fetch_assoc($get_allnotification)) {
                                if ($retriveNoti['Actions'] == 'debit') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'credit') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanSanctioned') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanRejected') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'FDCreated') {
                                    echo "<p class='greenNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'FDBreaked') {
                                    echo "<p class='redNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'other') {
                                    echo "<p class='blueNoti'>" . $retriveNoti['Message'] . "</p>";
                                }
                                if ($retriveNoti['Actions'] == 'loanPaid') {
                                    echo "<p class='blueNoti'>".$retriveNoti['Time']." - "  . $retriveNoti['Message'] . "</p>";
                                }
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="notification-type">
            <div class="filter">
                <form action="" method="post">
                    <button name="all">All</button>
                    <button name="transactions">Transactions</button>
                    <button name="loans">Loans</button>
                    <button name="investments">Investments</button>
                    <button name="others">Others</button>
                </form>
            </div>
        </div>
    </div>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>
