<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
    <script src="/assets/javascript/app.js"></script>
    <?php
    session_start();
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    if (isset($_POST['submit'])) {

        $email = strtolower($_POST['email']);
        $pass = $_POST['password'];
        // echo $pass;
        $sql = "SELECT * FROM employees WHERE EmployeeEmail='$email';";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $EmployeeEmail = $row['EmployeeEmail'];
            $Password = $row['Password'];
            $role = $row['EmployeeRole'];
            if ($email == $EmployeeEmail && $pass == $Password && $role == 'clerk') {
                $_SESSION["isLoggedin"] = true;
                $_SESSION["email"] = $email;
                // $_SESSION["lastLogin"]=time();
                header("location: ./components/employee/clerk_dashboard.php");
            } else if ($email == $EmployeeEmail && $pass == $Password && $role == 'manager') {
                $_SESSION["isLoggedin"] = true;
                $_SESSION["email"] = $email;
                header("location: ./components/employee/manager_dashboard.php");
            } else {
                $error_message = 'Please enter valid password';
            }
        } else {
            $error_message = 'Please enter valid email and password';
        }
    }
    ?>
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
            <h1>EMPLOYEE LOGIN</h1>
            <div class="link">
                <a href="/components/extra/contactus.php">Need help?</a>
                <a href="/components/extra/faqs.php">FAQs</a>
            </div>
        </div>
        <div class="wrapper">
            <section class="form login">
                <form action="employee_login.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="error-text"></div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="Enter your employee email" required>
                    </div>
                    <div class="field input">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                        <i class="fas fa-eye"></i>
                    </div>
                    <script src="/assets/javascript/pass-show-hide.js"></script>
                    <div class="field button">
                        <input type="submit" name="submit" value="Log in">
                    </div>
                </form>
            </section>
        </div>
    </main>
    <footer class="login-page">
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved. |
            <a href="/about">About Us</a> |
            <a href="/services">Services</a> |
            <a href="/faq">FAQs</a> |
            <a href="/terms">Terms and Conditions</a> |
            <a href="/privacy">Privacy Policy</a>
        </p>
    </footer>
</body>

</html>
<?php
if (isset($error_message)) {

    echo "<script>
var err = document.getElementsByClassName('error-text')[0];
err.innerText = '$error_message';
err.style.display = 'block';
</script>";
}
?>