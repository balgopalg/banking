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
require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php"; 
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
$email = $_SESSION['email'];
$get_employee = mysqli_query($conn, "SELECT * FROM employees,branch WHERE employees.EmployeeEmail = '$email' AND employees.EmployeeBranch=branch.ID");
$row = mysqli_fetch_assoc($get_employee);
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
                <div class="branchIFSC">
                    BRANCH : <?php echo  $row['IFSC']; ?>
                </div>
                Welcome 👋 <?php echo strtoupper($row['EmployeeName']); ?>
                <div class="dropdown">
                    <img src="/images/clerk.jpg" alt="">
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
                    <li><a href="clerk_dashboard.php">Search Accounts</a></li>
                    <li><a href="approveApp.php">Approve Application</a></li>
                    <li><a href="fund_transfer.php">Fund Transfer</a></li>
                    <li><a href="deposit_withdraw.php">Deposit/Withdraw</a></li>
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
    <main>
        <div class="window">
            <div class="wrapper">
                <section class="form login">
                    <form action="deposit_withdraw.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="error-text"></div>
                        <div class="radio">
                            <div>
                                <input type="radio" name="actions" id="deposit" value="deposit" required> Deposit
                            </div>
                            <div>
                                <input type="radio" name="actions" id="withdraw" value="withdraw"> Withdraw
                            </div>
                        </div>
                        <div class="field input">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Enter Receivers Name" required>
                        </div>
                        <div class="field input">
                            <label>Account no</label>
                            <input type="number" name="accountno" placeholder="Enter Account Number" required>
                        </div>
                        <div class="field input">
                            <label>IFS Code</label>
                            <input type="text" name="ifsc" placeholder="Enter IFSC" required>
                        </div>
                        <div class="field input">
                            <label>Amount</label>
                            <input type="number" name="amount" placeholder="Enter Amount" required>
                        </div>
                        <div class="field button">
                            <input type="submit" name="submit" value="Make Transaction">
                        </div>
                    </form>
                </section>
            </div>
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
    include 'functions.php';
    $accountNo = $_POST['accountno'];
    $ifsc = strtoupper($_POST['ifsc']);
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $action = $_POST['actions'];
    $get_details = mysqli_query($conn, "SELECT * FROM customers WHERE customers.IFSC='$ifsc' AND customers.AccountNo='$accountNo';");
    if (mysqli_num_rows($get_details) > 0) {
        $fetch_data = mysqli_fetch_assoc($get_details);
        $balance = $fetch_data['Balance'];
        if ($action == 'deposit') {
            deposit($accountNo, $amount, $balance);
        }
        if ($action == 'withdraw') {
            if ($balance < $amount) {
                echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Insufficient Balance in account !!! Rs. $balance';
        err.style.display='block';
        </script>";
            } else {
                withdraw($accountNo, $amount, $balance);
            }
        }
    } else {
        echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Invalid Account no / IFSC code ';
        err.style.display='block';
        </script>";
    }
}
?>