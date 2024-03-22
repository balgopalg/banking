<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="/style.css">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    $getAnnnounments = mysqli_query($conn, "SELECT * FROM announcements;");
    ?>
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
            <div>
                <ul>
                    <li><a href="/index.php">HOME</a></li>
                    <li><a href="/components/extra/about-us.php">ABOUT US</a></li>
                    <li><a href="/components/extra/products.php">PRODUCTS</a></li>
                    <li><a href="/components/extra/rates.php">RATES</a></li>
                    <li><a href="/components/extra/contactus.php">CONTACT US</a></li>
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
        <h3>ANNOUNCEMENTS</h3>
    </div>
    <div class='announce'>
        <div class="container">
            <?php
            while($get_date=mysqli_fetch_assoc($getAnnnounments)){
                echo '
                <div class="box">
                    <h4>
                    <div>'.$get_date["AnnouncementDate"].'  -
                    '.$get_date["Subject"].'</div>
                        <a href="'.$get_date["Link"].'">Click here</a>
                    </h4>
                    <p>'.$get_date["AnnouncementMessage"].'</p>
                </div>
                ';
            }
            ?>
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