<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/assets/javascript/app.js"></script>
    <link rel="stylesheet" href="style.css">
    <?php
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    $getAnnnounments = mysqli_query($conn, "SELECT * FROM announcements;");
    ?>
</head>

<body>
    <nav class="navbar">
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
        <div class="dropdown">
            <span class="material-symbols-outlined users">account_circle</span>
            <div class="items">
                <a href="customer_login.php">Customer</a>
                <a href="employee_login.php">Staff</a>
                <a href="admin_login.php">Admin</a>
            </div>
        </div>
    </div>
    <div class="index-main">
        <div class="images-frame">
            <div class="slider-frame">
                <div class="slide-images">
                    <div class="img-container">
                        <img src="./images/img1.jpg">
                    </div>
                    <div class="img-container">
                        <img src="./images/img2.jpg">
                    </div>
                    <div class="img-container">
                        <img src="./images/img3.jpg">
                    </div>
                </div>
            </div>
            <div class="announcements">
                <h3>
                    <div>
                        <span class="material-symbols-outlined">
                            campaign
                        </span>
                    </div>
                    <div class="viewall">
                        <h4>ANNOUNCEMENT</h4>
                        <h6><a href="/components/announcements/announcements.php">VIEW ALL</a></h6>
                    </div>
                </h3>
                <div class="subject">
                    <ul>
                        <marquee behavior="" direction="up">
                            <?php
                            while ($row = mysqli_fetch_assoc($getAnnnounments)) {
                                echo "
                                <li><a onmouseover='stop()' onMouseOut='start()' href='" . $row['Link'] . "'>" . $row['Subject'] . "</li></a>";
                            }
                            ?>
                        </marquee>
                        <script>
                            const marquee = document.querySelector('marquee');

                            function stop() {
                                marquee.stop();
                            }

                            function start() {
                                marquee.start();
                            }
                        </script>
                    </ul>
                </div>
            </div>
        </div>
        <div class="branch-locator">
            <div>
                <h3 class='pointer'>Locate Near By Branch</h3>
            </div>
            <div class="search-box">
                <h3>Branch locator</h3>
                <form action="locate_branch.php" method="post">
                    <input type="text" class="input-branch" name="input-branch" placeholder="Pincode/District/Branch" required autocomplete="off">
                    <input type="submit" class="submit-btn" name="branch-search" value="Find">
                </form>
            </div>
        </div>
        <!-- <div class="branch-locator">
            <div>
                <h3 class='pointer'>Locate Near By Branch</h3>
            </div>
            <div class="search-box">
                <h2>Branch Locator</h2>
                <form action="assets/php/ifscFinder.php" method="post">
                    <input type="text" class="input-branch" name="ifsc" placeholder="Pincode/District/Branch" required autocomplete="off">
                    <input type="submit" class="submit-btn" name="get_ifsc" value="Find">
                </form>
            </div>
        </div> -->
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