<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak - Products</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .container{
            grid-template-columns: repeat(3, 1fr); 
            min-width: 1000px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="top-nav">
            <div>
                <a href="#">
                    <img src="/images/logo.jpg" alt="">
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
                <li><a href="about-us.php">ABOUT US</a></li>
                <li><a href="products.php">PRODUCTS</a></li>
                <li><a href="rates.php">RATES</a></li>
                <li><a href="contactus.php">CONTACT US</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <span class="material-symbols-outlined users">account_circle</span>
            <div class="items">
                <a href="/customer_login.php">Customer</a>
                <a href="/employee_login.php">Staff</a>
                <a href="/admin_login.php">Admin</a>
            </div>
        </div>
    </div>
    <div class="banner">
        <h2>Products</h2>
    </div>
    <div class="container">
        <div class="product">
            <h3>Personal Loans</h3>
            <p>Get the financial support you need with our flexible personal loan options tailored to your individual requirements.</p>
            <a href="rates.php">Click here</a>
        </div>
        <div class="product">
            <h3>Study Loans</h3>
            <p>Invest in your education with our study loan solutions designed to cover tuition fees, books, and other educational expenses.</p><a href="rates.php">Click here</a>
        </div>
        <div class="product">
            <h3>Car Loans</h3>
            <p>Drive home your dream car with our hassle-free car loan packages featuring competitive interest rates and easy repayment terms.</p><a href="rates.php">Click here</a>
        </div>
        <div class="product">
            <h3>Home Loans</h3>
            <p>Turn your dream of owning a home into reality with our range of home loan products offering attractive interest rates and flexible repayment options.</p><a href="rates.php">Click here</a>
        </div>
        <div class="product">
            <h3>Business Loans</h3>
            <p>Grow your business with our customized business loan solutions designed to meet the financial needs of small, medium, and large enterprises.</p><a href="rates.php">Click here</a>
        </div>
        <div class="product">
            <h3>Fixed Deposit (FD)</h3>
            <p>Secure your savings and enjoy attractive returns with our fixed deposit schemes offering competitive interest rates and flexible deposit terms.</p><a href="rates.php">Click here</a>
        </div>
    </div>
    <footer>
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