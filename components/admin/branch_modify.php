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
            <h3>Modify Branch</h3>
        </div>
        <div class="modify-main">
            <div class="table">
                <table id="myTable" class="styled-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Branch Name</th>
                            <th>IFSC</th>
                            <th>Branch Manager</th>
                            <th>Phone no</th>
                            <th>Email </th>
                            <th>Pincode</th>
                            <th>Action</th>
                            <th style="display:none;">hidden</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_branch = mysqli_query($conn, "SELECT * FROM branch");

                        if (mysqli_num_rows($get_branch) > 0) {
                            while ($branch = $get_branch->fetch_assoc()) {
                                echo "<tr>
                    <td>" . $branch['ID'] . "</td>
                    <td>" . $branch['BranchName'] . "</td>
                    <td>" . $branch['IFSC'] . "</td>
                    <td>" . $branch['BranchManager'] . "</td>
                    <td>" . $branch['Phone'] . "</td>
                    <td>" . $branch['Email'] . "</td>
                    <td>" . $branch['Pincode'] . "</td>
                    <td>
                    <button onclick='openForm(this)'>Modify</button>
                    <form method='post'>
                    <input type='hidden' name='id' value='" . $branch['ID'] . "'>
                    <button name='delete'>Delete</button>
                    </form>
                    </td>
                    <td class='hidden-form' id='hidden' style='display:none; position:absolute;'>
                            <div class='container'>
                                <h2><button onclick='closeForm(this)' style='width:32px'>X</button></h2>
                                <h3>Update Branch : " . $branch['BranchName'] . "</h3>
                                <form action='' method='post'>
                                    <input type='hidden' name='BID' value='" . $branch['ID'] . "'/>
                                    <label for='branchManager'>Branch Manager</label>
                                    <input type='text' name='branchManager' value='" . $branch['BranchManager'] . "'/>
                                    <label for='phone'>Phone</label>
                                    <input type='text' name='phone' value='" . $branch['Phone'] . "'/>
                                    <label for='email'>Email</label>
                                    <input type='text' name='email' value='" . $branch['Email'] . "'/>
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

            <div class="wrapper" style="width:300px">
                <section class="form login">
                    <form action="" method="POST" enctype="multipart/form-data" autocomplete="off">
                        <header>Add Branch</header>
                        <div class="error-text"></div>
                        <div class="field input">
                            <label>Branch Name</label>
                            <input type="text" name="branchName" placeholder="Enter Branch Name" required>
                        </div>
                        <div class="field input">
                            <label>IFSC</label>
                            <input type="text" name="ifsc" placeholder="Enter Branch IFSC" required>
                        </div>
                        <div class="field input">
                            <label>Branch Manager</label>
                            <input type="text" name="manager" placeholder="Enter Branch Manager" required>
                        </div>
                        <div class="field input">
                            <label>Phone No</label>
                            <input type="number" name="phone" placeholder="Enter Phone no" required>
                        </div>
                        <div class="field input">
                            <label>Email</label>
                            <input type="text" name="email" placeholder="Enter Email" required>
                        </div>
                        <div class="field input">
                            <label>Classification:</label>
                            <select name="classification" id="classification">
                                <option value="rural">RURAL</option>
                                <option value="urban">URBAN</option>
                            </select>
                        </div>
                        <div class="field input">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="Enter Address" required>
                        </div>
                        <div class="field input">
                            <label>District</label>
                            <input type="text" name="district" placeholder="Enter District" required>
                        </div>
                        <div class="field input">
                            <label>State</label>
                            <input type="text" name="state" placeholder="Enter State" required>
                        </div>
                        <div class="field input">
                            <label>Pincode</label>
                            <input type="text" name="pincode" placeholder="Enter Pincode" required>
                        </div>
                        <div class="field button">
                            <input type="submit" name="submit" value="Add branch">
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
    $branchName = $_POST['branchName'];
    $ifsc = strtoupper($_POST['ifsc']);
    $manager = $_POST['manager'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $classification = $_POST['classification'];
    $address = $_POST['address'];
    $dist = $_POST['district'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    if (mysqli_query($conn, "INSERT INTO `branch`(`BranchName`, `BranchManager`, `Address`, `District`, `State`, `Pincode`, `IFSC`, `Classification`, `Phone`, `Email`) VALUES ('$branchName','$manager','$address','$dist','$state','$pincode','$ifsc','$classification',$phone,'$email')")) {
        echo "<script>alert('Branch added'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    } else {
        echo "<script>alert('user already exist');</script>";
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    if (mysqli_query($conn, "DELETE FROM branch WHERE ID=$id")) {
        echo "<script>alert('Branch deletion successful'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }
}

if (isset($_POST['update'])) {
    echo $id=$_POST['BID'];
    echo $managerName=$_POST['branchManager'];
    echo $phone=$_POST['phone'];
    echo $email=$_POST['email'];
    if(mysqli_query($conn, "UPDATE branch SET BranchManager='$managerName', Phone='$phone', Email='$email' WHERE ID=$id")){
        echo "<script>alert('Branch Updation successful'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
    }
}
?>