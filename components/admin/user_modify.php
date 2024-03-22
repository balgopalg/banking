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
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
$email = $_SESSION['email'];

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
            <h3>Modify Users</h3>
        </div>
        <div class="modify-main">
            <div class="table">
                <table id="myTable" class="styled-table">
                    <thead>
                        <tr>
                            <th>EmployeeID</th>
                            <th>Employee Name</th>
                            <th>Employee Email</th>
                            <th>User Name</th>
                            <th>IFSC</th>
                            <th>Role</th>
                            <th>Action</th>
                            <th style="display:none;">hidden</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_employees = mysqli_query($conn, "SELECT * FROM employees;");

                        if (mysqli_num_rows($get_employees) > 0) {
                            while ($employees = $get_employees->fetch_assoc()) {
                                echo "<tr>
                        <td>" . $employees['EmployeeID'] . "</td>
                        <td>" . $employees['EmployeeName'] . "</td>
                        <td>" . $employees['EmployeeEmail'] . "</td>
                        <td>" . $employees['UserName'] . "</td>
                        <td>" . $employees['EmployeeIFSC'] . "</td>
                        <td>" . $employees['EmployeeRole'] . "</td>
                        <td>
                            <button onclick='openForm(this)'>Modify</button>
                            <form method='post'>
                                <input type='hidden' name='email' value='" . $employees['EmployeeEmail'] . "'>
                                <button name='terminate'>Terminate</button>
                            </form>
                            
                        </td>
                        <td class='hidden-form' id='hidden' style='display:none; position:absolute;'>
                            <div class='container'>
                                <h2><button onclick='closeForm(this)' style='width:32px'>X</button></h2>
                                <h3>Update User : " . $employees['UserName'] . "</h3>
                                <form action='' method='post'>
                                    <input type='hidden' name='EID' value='" . $employees['EmployeeID'] . "'/>
                                    <label for='branch'>Branch</label>
                                    <select name='branch'>
                                        <option value='" . $employees['EmployeeBranch'] . "'>" . $employees['EmployeeIFSC'] . "</option>
                                        ";
                                $get_branch = mysqli_query($conn, "SELECT * FROM branch");
                                while ($branchData = mysqli_fetch_assoc($get_branch)) {
                                    echo "<option value='" . $branchData['ID'] . "'>" . $branchData['IFSC'] . "</option>";
                                }
                                echo "
                                    </select>
                                    <label for='name'>Name</label>
                                    <input type='text' name='name' value='" . $employees['EmployeeName'] . "'/>
                                    <label for='email'>Email</label>
                                    <input type='text' name='email' value='" . $employees['EmployeeEmail'] . "'/>
                                    <label for='username'>Username</label>
                                    <input type='text' name='username' value='" . $employees['UserName'] . "'/>
                                    <label for='password'>Password</label>
                                    <input type='text' name='password' value='" . $employees['Password'] . "'/>
                                    <label for='role'>Role</label>
                                    <select name='role' id='Role'>
                                        <option value='clerk'>CLERK</option>
                                        <option value='manager'>MANAGER</option>
                                    </select>
                                    <input type='submit' name='update' value='Update'>
                                </form>
                            </div>
                        </td>
                    </tr>";
                            }
                        } else {
                            echo "No record found";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
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
            <div class="wrapper" style="width:300px;">
                <section class="form login">
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <header>Add User</header>
                        <div class="error-text"></div>

                        <div class="field input">
                            <label>Branch</label>
                            <select name="branch" id="branch">
                                <?php
                                $get_branch = mysqli_query($conn, "SELECT * FROM branch");
                                while ($branchData = mysqli_fetch_assoc($get_branch)) {
                                    echo "<option value='" . $branchData['ID'] . "'>" . $branchData['IFSC'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="field input">
                            <label>Employee Name</label>
                            <input type="text" name="name" placeholder="Employee Name" required>
                        </div>
                        <div class="field input">
                            <label>Employee Email</label>
                            <input type="email" name="email" placeholder="Employee Email" required>
                        </div>
                        <div class="field input">
                            <label>Username</label>
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                        <div class="field input">
                            <label>Password</label>
                            <input type="password" name="password" placeholder="Password" required>
                        </div>
                        <div class="field input">
                            <label>Employee Role:</label>
                            <select name="role" id="Role">
                                <option value="clerk">CLERK</option>
                                <option value="manager">MANAGER</option>
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
    $branchID = $_POST['branch'];
    $ifsc = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFSC FROM branch WHERE ID='$branchID'"))['IFSC'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $uname = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM employees WHERE EmployeeEmail='$email' OR UserName='$uname'")) == 0) {
        if (mysqli_query($conn, "INSERT INTO `employees`(`EmployeeName`, `EmployeeEmail`, `UserName`, `Password`,`EmployeeIFSC` ,`EmployeeBranch`, `EmployeeRole`) VALUES ('$name','$email','$uname','$password','$ifsc',$branchID,'$role')")) {
            echo "<script>alert('Employee Hired'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
            exit();
        }
    } else {
        echo "<script>alert('user already exist');</script>";
    }
}
if (isset($_POST['terminate'])) {
    $Temail = $_POST['email'];
    if (mysqli_query($conn, "DELETE FROM employees WHERE EmployeeEmail='$Temail'")) {
        echo "<script>alert('$Temail - is terminated'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit();
    }
}

if (isset($_POST['update'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $branch = $_POST['branch'];
    $username = $_POST['username'];
    $name = $_POST['name'];
    $role = $_POST['role'];
    $id = $_POST['EID'];
    if ($getIFSC = mysqli_query($conn, "SELECT IFSC FROM branch WHERE ID=$branch")) {
        $fetch = mysqli_fetch_assoc($getIFSC);
        $EmpIfsc = $fetch['IFSC'];
    }
    if (mysqli_query($conn, "UPDATE `employees` SET `EmployeeName`='$name',`EmployeeEmail`='$email',`UserName`='$username',`Password`='$password',`EmployeeIFSC`='$EmpIfsc',`EmployeeBranch`='$branch',`EmployeeRole`='$role' WHERE EmployeeID=$id")) {
        echo "<script>alert('User details updated'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit();
    }
}
?>