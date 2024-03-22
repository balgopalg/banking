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
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    $email = $_SESSION['email'];
    $sql = mysqli_query($conn, "SELECT * FROM customers WHERE email='$email';");
    $row = mysqli_fetch_assoc($sql);
    $ifsc = $row['IFSC'];
    $branchName = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM branch WHERE IFSC='$ifsc'"))['BranchName'];
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
                <div>
                    Welcome <?php echo $row['UserName']; ?> 👋
                </div>
                <div class="dropdown">
                    <img src="/images/<?php echo $row['img']; ?>" class="users" alt="">
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
    <main class="profile-main">
        <div class="pic">
            <img src="/images/<?php echo $row['img']; ?>" class="profile-pic" alt="">
            <div style="    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    font-size:14px;">
                <h4>IFSC: <?php echo $row['IFSC']; ?></h4>
                <h4>Home Branch: <?php echo $branchName; ?></h4>
            </div>
        </div>
        <div class="wrapper">
            <section class="form signup">
                <header>Profile</header>
                <form action="profile.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <input type="number" name="accountno" value="<?php echo $row['AccountNo']; ?>" hidden>
                    <div class="error-text"></div>
                    <div class="field input">
                        <label>Fullname</label>
                        <input type="text" name="fname" placeholder="<?php echo $row['FullName'] ?>" value="<?php echo $row['FullName'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>Username</label>
                        <input type="text" name="uname" placeholder="<?php echo $row['UserName'] ?>" value="<?php echo $row['UserName'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>Email Address</label>
                        <input type="text" name="email" placeholder="<?php echo $row['Email'] ?>" value="<?php echo $row['Email'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>Phone no</label>
                        <input type="text" name="phoneno" placeholder="<?php echo $row['PhoneNo'] ?>" value="<?php echo $row['PhoneNo'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>Address</label>
                        <input type="text" name="address" placeholder="<?php echo $row['Address'] ?>" value="<?php echo $row['Address'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>District</label>
                        <input type="text" name="district" placeholder="<?php echo $row['District'] ?>" value="<?php echo $row['District'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>State</label>
                        <input type="text" name="state" placeholder="<?php echo $row['State'] ?>" value="<?php echo $row['State'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>Pincode</label>
                        <input type="text" name="pincode" placeholder="<?php echo $row['Pincode'] ?>" value="<?php echo $row['Pincode'] ?>" required>
                    </div>
                    <div class="field input">
                        <label>Aadhaar No</label>
                        <input type="text" name="aadhaar" placeholder="<?php echo $row['AadhaarNo'] ?>" value="<?php echo $row['AadhaarNo'] ?>" required>
                    </div>
                    <div class="field button">
                        <!-- <input type="submit" name="submit" value="Update"> -->
                        <!-- <input type="submit" onclick="window.print()" value="Print"> -->
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
    $accountno = $_POST['accountno'];
    $name = $_POST['fname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $aadhaar = $_POST['aadhaar'];
    if (mysqli_query($conn, "UPDATE `customers` SET `FullName`='$name',`UserName`='$username',`PhoneNo`='$phoneno',`Email`='$email',`Address`='$address',`District`='$district',`State`='$state',`Pincode`='$pincode',`AadhaarNo`='$aadhaar' WHERE `AccountNo` = '$accountno';")) {
        echo "<script> alert('updated'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "'; </script>";
    }
}


?>