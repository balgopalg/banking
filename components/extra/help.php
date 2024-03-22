<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak - Help</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="style.css">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1,
        .container h2,
        .container h3 {
            color: #333;
        }

        .container p {
            color: #666;
        }

        .container ol {
            margin-left: 20px;
        }

        .container .steps {
            display: flex;
            flex-direction: column;
            padding: 20px 5px;
            gap: 20px;
        }

        .container .steps ol {
            list-style-type: decimal;
        }

        .container .info {
            background-color: #f9f9f9;
            padding: 10px;
            border-left: 4px solid #4CAF50;
            margin-top: 10px;
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
        <h3>Help</h3>
    </div>
    <div class="container">
        <div class="steps">
            <h2>Login Procedure:</h2>
            <ol>
                <li>Visit the Bank of Bhadrak website.</li>
                <li>Click on the "Login" button.</li>
                <li>Enter your username and password.</li>
                <li>Click on the "Login" button to access your account.</li>
            </ol>
            <div class="info">
                <p>If you have forgotten your username or password, use the "Forgot Password" link on the login page to reset them.</p>
            </div>
        </div>
        <div class="steps">
            <h2>Account Opening Procedure:</h2>
            <ol>
                <li>Visit the Bank of Bhadrak website.</li>
                <li>Click on the "Open an Account" option.</li>
                <li>Fill out the account opening form with your details.</li>
                <li>Submit the form along with required documents.</li>
                <li>Wait for verification and approval from the bank.</li>
            </ol>
            <div class="info">
                <p>Ensure that you have all necessary documents such as ID proof, address proof, and passport-size photographs before filling out the form.</p>
            </div>
        </div>
        <div class="steps">
            <h2>Loan Application Procedure:</h2>
            <ol>
                <li>Login to your Bank of Bhadrak account.</li>
                <li>Go to the "Loan" section.</li>
                <li>Select the type of loan you want to apply for.</li>
                <li>Fill out the loan application form with necessary details.</li>
                <li>Submit the form along with required documents.</li>
                <li>Wait for the bank's decision on your loan application.</li>
            </ol>
            <div class="info">
                <p>Make sure to provide accurate financial information and necessary collateral details if applicable.</p>
            </div>
        </div>
        <p>If you have any further questions or need assistance, feel free to contact our customer support.</p>
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