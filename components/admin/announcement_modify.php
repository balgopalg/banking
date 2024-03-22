<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<?php
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
$branchcount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM branch"))['count'];

$employeecount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM employees"))['count'];
$clerkcount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM employees WHERE EmployeeRole='clerk'"))['count'];
$managercount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM employees WHERE EmployeeRole='manager'"))['count'];

$customercount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM customers"))['count'];
$activeCustomerCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM customers WHERE Status='ACTIVE'"))['count'];
$inactiveCustomerCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT count(*) as count FROM customers WHERE Status='INACTIVE'"))['count'];
$loanDetails = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(LoanAmount) as totalLoanAmount, SUM(LoanPaid) as totalLoanRecovered FROM loanapp"));
$totalTransactionAmount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(TransactionAmount) as totalTransactionAmount FROM transactions"))['totalTransactionAmount'];
?>


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
                <h4>
                    Welcome ADMIN 👋
                </h4>
                <div class="dropdown">
                    <img src="/images/admin.jpg" class="users" alt="">
                    <div class="items">
                        <a href="/assets/php/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="bottom-nav">
            <div class="s1">
                <ul>
                    <li><a href="admin_dashboard.php">Dashboard</a></li>
                    <li><a href="user_modify.php">User modify</a></li>
                    <li><a href="branch_modify.php">Branch modify</a></li>
                    <li><a href="announcement_modify.php">Modify announcements</a></li>
                    <li><a href="enquiry.php">Enquiries</a></li>
                </ul>
            </div>
            <div>
                <div class="tooltip">
                    <a href=""> <button>
                            <i class="fa-solid fa-arrows-rotate"></i>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    <main class="announcement-main">
        <div class="container">
            <h2>Add Announcement</h2>
            <form action="" method="post">
                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="6" required></textarea>

                <label for="location">Location:</label>
                <input type="text" id="location" name="location" required>

                <input type="submit" name="submit" value="Send Message">
            </form>
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
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $location = $_POST['location'];
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($location == 'na') {
        $location = "/components/announcements/announcements.php";
        $sql = "INSERT INTO announcements (Subject, AnnouncementMessage, Link) VALUES ('$subject', '$message', '$location')";
    } else {
        $sql = "INSERT INTO announcements (Subject, AnnouncementMessage, Link) VALUES ('$subject', '$message', '$location')";
    }

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('New announcement added'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>