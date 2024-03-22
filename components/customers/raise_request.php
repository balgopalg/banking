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
    require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
    $find_user = mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email';");
    $row = mysqli_fetch_assoc($find_user);
    $name = $row['FullName'];
    $userName = $row['UserName'];
    $accountNo = $row['AccountNo'];
    $balance = $row['Balance'];
    $img = $row['img']; ?>
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
                Welcome <?php echo "$userName"; ?>
                <div class="dropdown">
                    <img src="/images/<?php echo "$img"; ?>" class="users" alt="">
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

    <main class="raise-request-main">
        <div class="container">
            <h2>Raise a Request</h2>
            <form action="raise_request.php" method="post">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
                <input type="hidden" name="accountno" value="<?php echo $accountNo ?>">
                <input type="hidden" name="name" value="<?php echo $row['FullName'] ?>">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="6" required></textarea>
                <input type="submit" name="submit" value="Send Message">
            </form>
        </div>
    </main>

    <section class="view-replies">
        <div>
            <h2>Request history</h2>
        </div>
        <div class="table">
            <?php
            $get_request = mysqli_query($conn, "SELECT * FROM rmrequest WHERE customerAccountNo=$accountNo");
            if (mysqli_num_rows($get_request) > 0) {
                echo '<table class="styled-table">
                    <thead>
                        <tr>
                            <th>ReqID</th>
                            <th>Customer Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                while ($reqs = $get_request->fetch_assoc()) {
                    $reqID = $reqs['ID'];
                    echo "<tr style='height:50px;'>      
                                <td>" . $reqs['ID'] . "</td>
                                <td>" . $reqs['customerName'] . "</td>
                                <td>" . $reqs['subject'] . "</td>
                                <td>" . $reqs['message'] . "</td>
                                <td>
                                <form method='post'>
                                <input name='reqid' value='" . $reqs['ID'] . "' hidden>
                                <button name='delete'>Delete</button>
                                </form>
                                </td>
                            </tr>";
                    $get_replies = mysqli_query($conn, "SELECT * FROM replies WHERE reqID = $reqID");

                    if (mysqli_num_rows($get_replies) > 0) {
                        $reply = mysqli_fetch_assoc($get_replies);
                        echo "<tr class='hidden-form'>
                            <td colspan='5'>
                                <div class='container'> 
                                    <h5>Reply for reqest id. " . $reqs['ID'] . "</h5>
                                    <h4>" . $reply['subject'] . "</h4>
                                    <p>" . $reply['message'] . "</p>
                                </div>
                            </td>
                        </tr>";
                    } else {
                        echo "<tr class='hidden-form'>
                            <td colspan='5'>
                                <div class='container'> 
                                    No reply yet.
                                </div>
                            </td>
                        </tr>";
                    }
                }
                echo "</tbody></table>";
            } else {
                echo "no request found";
            }
            ?>
        </div>
    </section>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>
<?php
if (isset($_POST['submit'])) {
    $subject = mysqli_real_escape_string($conn, $_POST['subject']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);
    $accountno = mysqli_real_escape_string($conn, $_POST['accountno']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $ifsc = $row['IFSC'];
    $query = "INSERT INTO rmrequest (customerAccountNo,customerBranch, customerName, subject, message) VALUES ('$accountno','$ifsc', '$name', '$subject', '$message')";
    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Request received . wait for reply'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
if (isset($_POST['delete'])) {
    $reqID = $_POST['reqid'];
    $sql = "DELETE FROM rmrequest WHERE ID=$reqID";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Request deleted successfully'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }
}
?>