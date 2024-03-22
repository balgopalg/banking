<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/assets/javascript/app.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="preloader"></div>
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
        <h2>Contact us </h2>
    </div>
    <main>
        <section class="location">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d59576.60844808313!2d86.5026176!3d21.051162900000012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3a1bf587cd8ce1f1%3A0x820d86656eae5320!2sBhadrak%2C%20Odisha!5e0!3m2!1sen!2sin!4v1689783754652!5m2!1sen!2sin" width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </section>

        <section class="contact-us">
            <div class="row">
                <div class="contact-col">
                    <div>
                        <i class="fa fa-home"></i>
                        <span>
                            <h5>Bhadrak Autonomous College</h5>
                            <p>Bhadrak, Odisha, IN</p>
                        </span>
                    </div>
                    <div>
                        <i class="fa fa-phone"></i>
                        <span>
                            <h5>+91 826042914</h5>
                            <p>Monday to Saturday , 10AM to 5PM</p>
                        </span>
                    </div>
                    <div>
                        <i class="fa fa-envelope"></i>
                        <span>
                            <h5>imbalgopal@gmail.com</h5>
                            <p>Email us your query</p>
                        </span>
                    </div>
                </div>
                <div class="contact-col">
                    <form action="" method="post">
                        <input type="text" name="name" placeholder="Enter your name" required>
                        <input type="number" name="phoneno" placeholder="Enter your phoneno" required pattern="[0,9]{10}">
                        <input type="text" placeholder="Enter your subject" name="subject" required>
                        <textarea rows="8" placeholder="Message" name="message" required></textarea>
                        <button type="submit" name='submit' class="sub-btn">Send Message</button>
                    </form>
                </div>
            </div>
        </section>
    </main>
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

<?php
if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    $name = $_POST['name'];
    $phoneno = $_POST['phoneno'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    if (mysqli_query($conn, "INSERT INTO contactus (name,subject,phoneno,message) VALUES ('$name','$subject','$phoneno','$message')")) {
        echo "<script>alert('Message sent');</script>";
    }
}
?>