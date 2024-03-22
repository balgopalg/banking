<?php
require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
if (isset($_POST['submit'])) {
    $email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM customers WHERE Email = '$email' AND Status='ACTIVE'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $enc_pass = $row['Password'];

            if (md5($password) === $enc_pass) {
                $_SESSION['isLoggedin'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['LastLogin'] = $row['LastLogin'];
                $_SESSION['currentLogin'] = time();

                $balance = $row['Balance'];
                $accountNo = $row['AccountNo'];
                $LastLogin = $row['LastLogin'];
                $LastIntCreditDate = $row['lastInterestDate'];
                $lastIntDatee = DateTime::createFromFormat('Y-m-d', $LastIntCreditDate);
                $today = new DateTime('today');
                $diff = $lastIntDatee->diff($today);
                $formattedDate = $today->format('Y-m-d');

                if ($diff->days > 0) {
                    $dailyInterest = ($balance * $diff->days * 0.010958) / 100;
                    $newBalance = $balance + $dailyInterest;
                    mysqli_query($conn, "UPDATE `customers` SET `Balance`=$newBalance,lastInterestDate='$formattedDate'  WHERE `Email` = '$email';");
                    mysqli_query($conn, "INSERT INTO `transactions`(`TransactionAmount`,`Receiver`,`Actions`,`ReceiverBalance`) VALUES ('$dailyInterest','$accountNo','int._credited',$newBalance);");
                }

                if (mysqli_num_rows($get_fd = mysqli_query($conn, "SELECT * FROM fd WHERE customerAccountNo = $accountNo")) > 0) {
                    while ($fd_data = mysqli_fetch_assoc($get_fd)) {
                        $fdInterest = $fd_data['InterestRate'];
                        $currBalance = $fd_data['current_value'];
                        $fdOpenDate = $fd_data['FDOpeningDate'];
                        $fdBreakDate = $fd_data['FDBreakDate'];
                        $fdLastIntDate = $fd_data['lastIntCreditDate'];
                        $FDIntDatee = DateTime::createFromFormat('Y-m-d', $fdLastIntDate);
                        $FDBDatee = DateTime::createFromFormat('Y-m-d', $fdBreakDate);
                        $today = new DateTime();
                        $diffFD = $FDIntDatee->diff($today);
                        if ($diffFD->days > 0) {
                            $dailyFDint = $fdInterest / 365;
                            $dailyReturn = ($currBalance * $diffFD->days * $dailyFDint) / 100;
                            $newCurrBalance = $currBalance + $dailyReturn;
                            mysqli_query($conn, "UPDATE `fd` SET `current_value` = '$newCurrBalance', lastIntCreditDate='$formattedDate'  WHERE customerAccountNo = $accountNo;");
                        }
                    }
                }

                header('Location: ./components/customers/customer_dashboard.php');
                exit;
            } else {
                $error_message = 'Password is incorrect';
            }
        } else {
            $error_message = 'This email does not exist / Inactive account';
        }
    } else {
        $error_message = 'All input fields are required';
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/assets/javascript/app.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body style="flex-direction: column;">
    <nav class="navbar login-page">
        <div class="top-nav">
            <div>
                <a href="#">
                    <img src="./images/logo.jpg" alt="">
                    <p>Bank Of Bhadrak</p>
                </a>
            </div>
            <div class="help-line">
                <i class="fa-solid fa-phone"></i>
                <div>
                    National Helpline No
                    <br>
                    <a href="">
                        +918260429141
                    </a>
                </div>
            </div>
        </div>
    </nav>
    <div class="bottom-nav">
        <div class="s1">
            <ul>
                <li><a href="/index.php">HOME</a></li>
                <li><a href="/components/extra/about-us.php">ABOUT US</a></li>
                <li><a href="/components/extra/products.php">PRODUCTS</a></li>
                <li><a href="/components/extra/rates.php">RATES</a></li>
                <li><a href="/components/extra/contactus.php">CONTACT US</a></li>
            </ul>
        </div>
        <div class="dropdown login-page">
            <span class="material-symbols-outlined users">account_circle</span>
            <div class="items">
                <a href="customer_login.php">Customer</a>
                <a href="employee_login.php">Staff</a>
                <a href="admin_login.php">Admin</a>
            </div>
        </div>
    </div>
    <main class="clogin-main" style="height:355px;">
        <div class="bank-title">
            <h3>Welcome to Bank of Bhadrak</h3>
            <h1>INTERNET BANKING</h1>
            <div class="link">
                <a href="/components/extra/contactus.php">Need help?</a>
                <a href="/components/extra/faqs.php">FAQs</a>
            </div>
        </div>
        
        <div class="wrapper">
            <section class="form login">
                <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                        <i  class="fas fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" name="submit" value="Log in">
                    </div>
                </form>
                <div class="link">New user ? <a href="openaccount.php">Open an account now</a></div>
            </section>
        </div>
    </main>
    <script src="/assets/javascript/pass-show-hide.js"></script>
    <footer class="login-page">
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved. |
            <a href="/components/extra/about-us.php">About Us</a> |
            <a href="/components/extra/products.php">Services</a> |
            <a href="/components/extra/faqs.php">FAQs</a> |
            <a href="/components/extra/terms-conditions.php">Terms and Conditions</a> |
            <a href="/components/extra/privacy-policy.php">Privacy Policy</a>
        </p>
    </footer>
</body>

</html>

<?php
if (isset($error_message)) {
    echo "<script>
    var err = document.querySelector('.error-text');
    err.style.display='block';
    err.innerText='$error_message';
    </script>";
}
?>