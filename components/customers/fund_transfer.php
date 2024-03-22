<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
    <?php
    session_start();
    if ($_SESSION["isLoggedin"] == false) {
        header('location:/index.php');
    }
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    $email = $_SESSION['email'];
    // $get_data = mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email';");
    // $row = mysqli_fetch_assoc($get_data);
    $find_user = mysqli_query($conn, "SELECT * FROM customers WHERE Email='$email';");
    $row = mysqli_fetch_assoc($find_user);
    $name = $row['FullName'];
    $userName = $row['UserName'];
    $accountNo = $row['AccountNo'];
    $balance = $row['Balance'];
    $img = $row['img'];
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
    <main class="fund-transfer-main">
        <div class="form-section">
            <div class="title">
                <img src="https://img.freepik.com/free-vector/banking-industry-concept-illustration_114360-13934.jpg?size=626&ext=jpg" alt="">
                <h3>Fund Transfer Made Easy With Internet Banking</h3>
            </div>
            <div class="wrapper">
                <section class="form signup">
                    <header>Transfer Fund <span style="font-size: 13px;">Available balance : <?php echo $row['Balance']; ?></span></header>
                    <form action="fund_transfer.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="error-text"></div>
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
                        <div class="field input">
                            <label>Remark</label>
                            <input type="text" name="remark" placeholder="Remark" required>
                        </div>
                        <div class="field input">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter Password" required>
                            <i class="fas fa-eye"></i>
                        </div>

                        <div class="field button">
                            <input type="submit" name="submit" value="Make Transaction">
                        </div>
                    </form>
                </section>
            </div>
        </div>
        <div class="form-section" id='addpayee'>
            <div class="wrapper">
                <section class="form signup">
                    <header>Add Payee</header>
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <div class="error-text"></div>
                        <div class="field input">
                            <label>Nick Name</label>
                            <input type="text" name="nickname" placeholder="Enter Receivers Name" required>
                        </div>
                        <div class="field input">
                            <label>Name</label>
                            <input type="text" name="name" placeholder="Enter Receivers Name" required>
                        </div>
                        <div class="field input">
                            <label>Account no</label>
                            <input type="number" name="payeeAccountno" placeholder="Enter Account Number" required>
                        </div>
                        <div class="field input">
                            <label>IFS Code</label>
                            <input type="text" name="ifsc" placeholder="Enter IFSC" required>
                        </div>
                        <div class="field input">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter Password" required>
                            <i class="fas fa-eye"></i>
                        </div>
                        <script src="/assets/javascript/pass-show-hide.js"></script>
                        <div class="field button">
                            <input type="submit" name="addpayee" value="Add Payee">
                        </div>
                    </form>
                </section>
            </div>
            <div class="title">
                <h3>Add Payee Now to Save your time</h3>
                <img src="https://img.freepik.com/free-vector/banking-isometric-flowchart_1284-58041.jpg?t=st=1710145632~exp=1710149232~hmac=6edecbde1c82df308a366b96cfcd318a9b7f5b323fb9fb6037afa508f4274bf2&w=740" alt="">
            </div>
        </div>
        <style>
            .table {
                display: flex;
                flex-direction: column;
                align-items: center;
                padding: 30px;
                min-height: 300px;
            }

            .dataTables_filter {
                margin-bottom: 15px;
            }

            #myTable button {
                background-color: #001a33;
                cursor: pointer;
                padding: 5px 8px;
                border-radius: 6px;
                color: white;

                &:hover {
                    background-color: #721c24;
                }
            }
        </style>
        <div style="height: 400px;">
            <div class="banner" style="height: 30px; margin-bottom: 20px; background:#ea1973 ;">
                <h3>Payees</h3>
            </div>
            <table id="myTable" class="styled-table">
                <thead>
                    <tr>
                        <th>Payee Name</th>
                        <th>Payee Nickname</th>
                        <th>Payee Account No</th>
                        <th>Payee IFSC</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_payees_query = mysqli_query($conn, "SELECT * FROM payee WHERE CustomerAccNo=$accountNo");

                    if (mysqli_num_rows($get_payees_query) > 0) {
                        while ($get_payees = mysqli_fetch_assoc($get_payees_query)) {
                            echo "<tr>
                <td>" . $get_payees['payeeName'] . "</td>
                <td>" . $get_payees['payeeNickname'] . "</td>
                <td>" . $get_payees['payeeAccountNo'] . "</td>
                <td>" . $get_payees['payeeIFSC'] . "</td>
                <td>
                    <form method='post'>
                        <input type='hidden' value='" . $get_payees['payeeAccountNo'] . "' name='payeeAccount'>
                        <button type='submit' name='delete'>Delete</button>
                    </form>
                </td>
              </tr>";
                        }
                    }
                    ?>

                </tbody>
            </table>
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
    $sendersName = $row['FullName'];
    $sendersAccountNo = $row['AccountNo'];
    $receiversName = $_POST['name'];
    $receiversAccountNo = $_POST['accountno'];
    $amount = $_POST['amount'];
    $ifsc = $_POST['ifsc'];
    $remark = $_POST['remark'];
    $password = $_POST['password'];
    $encrypted_pass = md5($password);
    if ($row['Balance'] < $amount) {
        echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = 'Insufficient Balance';
        err.style.display='block';
        </script>";
    } else {
        include "functions.php";
        if ($sendersAccountNo == $receiversAccountNo) {
            echo "<script>var err = document.getElementsByClassName('error-text')[0];
            err.innerText = 'Self transfer not allowed !!';
            err.style.display='block';
            </script>";
        } else {
            if ($encrypted_pass == $row['Password']) {
                if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo=$receiversAccountNo AND IFSC='$ifsc'")) > 0) {
                    updateTransaction($sendersAccountNo, $receiversAccountNo, $amount, $remark);
                } else {
                    echo "<script>var err = document.getElementsByClassName('error-text')[0];
            err.innerText = 'Receiver not found';
            err.style.display='block';
            </script>";
                }
            } else {
                echo "<script>var err = document.getElementsByClassName('error-text')[0];
            err.innerText = 'Incorrect password';
            err.style.display='block';
            </script>";
            }
        }
    }
}
if (isset($_POST['addpayee'])) {
    $nickname = $_POST['nickname'];
    $name = $_POST['name'];
    $payeeAccountNo = $_POST['payeeAccountno'];
    $ifsc = strtoupper($_POST['ifsc']);
    $password = $_POST['password'];
    $encrypted_pass = md5($password);
    if ($encrypted_pass == $row['Password']) {
        if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM customers WHERE AccountNo='$payeeAccountNo' AND IFSC='$ifsc'")) > 0) {
            if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM payee WHERE payeeAccountNo='$payeeAccountNo' AND customerAccNo='$accountNo'")) == 0) {
                if (mysqli_query($conn, "INSERT INTO `payee`(`customerAccNo`, `payeeAccountNo`, `payeeName`, `payeeNickname`, `payeeIFSC`) VALUES ($accountNo,$payeeAccountNo,'$name','$nickname','$ifsc')")) {
                    echo "<script>alert('Payee added'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
                }
            } else {
                echo "<script>alert('Payee already exist');</script>";
            };
        } else {
            echo "<script>alert('User not found in Database');</script>";
        }
    } else {
        echo "<script>alert('Incorrect password');</script>";
    }
}

if (isset($_POST['delete'])) {
    $payeeAccountNo = $_POST['payeeAccount'];
    if (mysqli_query($conn, "DELETE FROM payee WHERE customerAccNo=$accountNo AND payeeAccountNo=$payeeAccountNo")) {
        echo "<script>alert('Payee Deleted successfully'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }
}
?>