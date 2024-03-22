<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="app.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
</head>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
$email = $_SESSION['email'];
$get_employee = mysqli_query($conn, "SELECT * FROM employees,branch WHERE employees.EmployeeEmail = '$email' AND employees.EmployeeBranch=branch.ID");
$row = mysqli_fetch_assoc($get_employee);
$ifsc = $row['IFSC'];
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
                    BRANCH : <?php echo $ifsc; ?>
                </div>
                Welcome 👋 <?php echo strtoupper($row['EmployeeName']); ?>
                <div class="dropdown">
                    <img src="/images/manager.jpg" alt="">
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
                <li><a href="manager_dashboard.php">Search Accounts</a></li>
                <li><a href="loanApp.php">Loan Applications</a></li>
                <li><a href="hireEmployee.php">Hire Employee</a></li>
                <li><a href="rm_manager.php">RM Requests</a></li>
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

        .dataTables_wrapper {
            width: 1000px;
        }
    </style>
    <main>
        <div class="banner">
            <h3>RM Requests</h3>
        </div>
        <div class="application-window">
            <div class="table">
                <table id="myTable" class="styled-table">
                    <thead>
                        <tr>
                            <th>Account No</th>
                            <th>ReqID</th>
                            <th>Customer Name</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Action</th>
                            <th style="display:none;">hidden</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_request = mysqli_query($conn, "SELECT * FROM rmrequest WHERE customerBranch='$ifsc'");
                        if (mysqli_num_rows($get_request) > 0) {
                            while ($reqs = $get_request->fetch_assoc()) {
                                echo "<tr style='height:50px;'>      
                            <td>" . $reqs['customerAccountNo'] . "</td>
                            <td>" . $reqs['ID'] . "</td>
                            <td>" . $reqs['customerName'] . "</td>
                            <td>" . $reqs['subject'] . "</td>
                            <td>" . $reqs['message'] . "</td>
                            <td>
                                <button onclick='openForm(this)'>Reply</button>
                            </td>
                            <td class='hidden-form' id='hidden' style='display:none; position:absolute;'>
                                <div class='container'>
                                    <h2><button onclick='closeForm(this)' style='width:32px'>X</button></h2>
                                    <h2>Reply to ReqID " . $reqs['ID'] . "</h2>
                                    <form action='' method='post'>
                                        <input type='hidden' name='accountno' value='" . $reqs['customerAccountNo'] . "'/>
                                        <input type='hidden' name='reqID' value='" . $reqs['ID'] . "'/>
                                        <label for='subject'>Subject</label>
                                        <input type='text' id='subject' name='subject' required>
                                        <label for='message'>Message</label>
                                        <textarea id='message' name='message' rows='6' required></textarea>
                                        <input type='submit' name='submitReply' value='Send Message'>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                            ";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <script>
        function openForm(btn) {
            var row = btn.closest('tr');
            var hiddenForm = row.querySelector('.hidden-form');
            hiddenForm.style.display = 'block';
        }

        function closeForm(btn) {
            var row = btn.closest('tr');
            var hiddenForm = row.querySelector('.hidden-form');
            hiddenForm.style.display = 'none';
        }
    </script>

    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>

</html>
<?php
if (isset($_POST['submitReply'])) {
    $accountno = $_POST['accountno'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $reqID = $_POST['reqID'];
    $accountno = mysqli_real_escape_string($conn, $accountno);
    $subject = mysqli_real_escape_string($conn, $subject);
    $message = mysqli_real_escape_string($conn, $message);
    $reqID = mysqli_real_escape_string($conn, $reqID);
    if (mysqli_query($conn, "INSERT INTO replies (reqID,accountno, subject, message) VALUES ($reqID,'$accountno', '$subject', '$message')")) {
        echo "<script>alert('Reply sent'); 
        window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit;
    }
}
?>