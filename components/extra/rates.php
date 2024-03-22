<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak - Interest Rates</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="style.css">

    <style>
        .container{
            grid-template-columns: repeat(2, 1fr); 
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
        <h2>Rates</h2>
    </div>
    <div class="container">
        <h2>Loan Interest Rates</h2>
        <table>
            <tr>
                <th>Loan Type</th>
                <th>Interest Rate (%)</th>
            </tr>
            <tr>
                <td>Personal Loan</td>
                <td>12.75</td>
            </tr>
            <tr>
                <td>Home Loan</td>
                <td>8.35</td>
            </tr>
            <tr>
                <td>Study Loan</td>
                <td>6.40</td>
            </tr>
            <tr>
                <td>Business Loan</td>
                <td>14.25</td>
            </tr>
            <tr>
                <td>Car Loan</td>
                <td>9.75</td>
            </tr>
        </table>
        <h2>Fixed Deposit Interest Rates</h2>
        <table>
            <tr>
                <th>Duration</th>
                <th>Interest Rate (%)</th>
            </tr>
            <tr>
                <td>7 days - 14 days</td>
                <td>2.80</td>
            </tr>
            <tr>
                <td>15 days - 29 days</td>
                <td>2.80</td>
            </tr>
            <tr>
                <td>30 days - 45 days</td>
                <td>3.00</td>
            </tr>
            <tr>
                <td>46 days - 90 days</td>
                <td>3.25</td>
            </tr>
            <tr>
                <td>91 days - 120 days</td>
                <td>3.50</td>
            </tr>
            <tr>
                <td>121 days - 180 days</td>
                <td>3.85</td>
            </tr>
            <tr>
                <td>181 days - less thean 9 months</td>
                <td>4.50</td>
            </tr>
            <tr>
                <td>9 months - less than 1 year</td>
                <td>4.75</td>
            </tr>
            <tr>
                <td>1 year</td>
                <td>6.10</td>
            </tr>
            <tr>
                <td>above 1 year - less than 2 year</td>
                <td>6.30</td>
            </tr>
            <tr>
                <td>2 year to less than 3 year</td>
                <td>6.70</td>
            </tr>
            <tr>
                <td>3 years to 5 years</td>
                <td>6.25</td>
            </tr>
            <tr>
                <td>5 years</td>
                <td>6.25</td>
            </tr>
            <tr>
                <td>More than 5 years</td>
                <td>6.10</td>
            </tr>
        </table>
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