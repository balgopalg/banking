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
$branchID = $row['ID'];
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
                    BRANCH : <?php echo  $ifsc; ?>
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
    </style>
    <main>
        <div class="banner">
            <h3>EMPLOYEE ACCOUNTS</h3>
        </div>
        <div class="hireemployee-main">
            <div class="table">
                <table id="myTable" class="styled-table">
                    <thead>
                        <tr>
                            <th>EmployeeID</th>
                            <th>Employee Name</th>
                            <th>Employee Email</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_employees = mysqli_query($conn, "SELECT DISTINCT employees.* FROM employees INNER JOIN branch ON employees.EmployeeBranch = branch.ID WHERE employees.EmployeeBranch = $branchID");

                        if (mysqli_num_rows($get_employees) > 0) {
                            while ($employees = $get_employees->fetch_assoc()) {
                                echo "<tr>
                    <td>" . $employees['EmployeeID'] . "</td>
                    <td>" . $employees['EmployeeName'] . "</td>
                    <td>" . $employees['EmployeeEmail'] . "</td>
                    <td>" . $employees['UserName'] . "</td>
                    <td>" . $employees['EmployeeRole'] . "</td>
                    <td><form method='post'>
                    <input type='hidden' name='role' value='" . $employees['EmployeeRole'] . "'>
                    <input type='hidden' name='email' value='" . $employees['EmployeeEmail'] . "'>
                    <button name='terminate'>Terminate</button>
                    </form>
                    </td>
                    </tr>";
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="wrapper" style="width:300px">
                <section class="form login">
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <header>Hire Employee</header>
                        <div class="error-text"></div>
                        <div class="field input">
                            <label>Employee Name</label>
                            <input type="text" name="name" placeholder="Enter Employee Name" required>
                        </div>
                        <div class="field input">
                            <label>Employee Email</label>
                            <input type="text" name="email" placeholder="Enter Employee mail" required>
                        </div>
                        <div class="field input">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Enter Username" required>
                        </div>
                        <div class="field input">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Enter Password" required>
                        </div>
                        <div class="field input">
                            <label>Employee Role:</label>
                            <select name="role" id="Role">
                                <option value="clerk">CLERK</option>
                            </select>
                        </div>

                        <div class="field button">
                            <input type="submit" name="submit" value="Hire Employee">
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
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if (mysqli_query($conn, "INSERT INTO `employees`(`EmployeeName`, `EmployeeEmail`, `UserName`, `Password`,`EmployeeIFSC` ,`EmployeeBranch`, `EmployeeRole`) VALUES ('$name','$email','$uname','$password','$ifsc',$branchID,'$role')")) {
        echo "<script>alert('Employee Hired'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        echo "<script>alert('user already exist');</script>";
    }
}
if (isset($_POST['terminate'])) {
    $Temail = $_POST['email'];
    $role = $_POST['role'];
    if ($role == 'manager') {
        echo "<script>alert('You are not authorized to terminate Manager');</script>";
    } else {
        if (mysqli_query($conn, "DELETE FROM employees WHERE EmployeeEmail='$Temail' AND EmployeeRole='$role'")) {
            echo "<script>alert('$Temail Employee Terminated'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        }
    }
}
?>