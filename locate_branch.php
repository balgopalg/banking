<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/javascript/pass-show-hide.js"></script>
    <link rel="stylesheet" href="style.css">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    if (isset($_POST['branch-search'])) {
        $input = $_POST['input-branch'];
        require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
        $getBranch = mysqli_query($conn, "SELECT * FROM branch WHERE BranchName LIKE '%$input%' OR District LIKE '%$input%' OR Pincode LIKE '%$input%';");
        if (mysqli_num_rows($getBranch) > 0) {
            $branchDetails = mysqli_fetch_array($getBranch);
        } else {
            header("location: index.php");
        }
    }
    ?>
</head>

<body style="flex-direction: column;">
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
    <section class="title branch-image">
        <h1>LOCATE BRANCH</h1>
    </section>

    <main class="branch-locator-main">
        <div class="branch-name">
            <div class="search">
                <input type="text" name="search" id="search" placeholder="<?php echo $input ?>" hidden>
            </div>
            <div class="result">
                <?php
                require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
                $get_branch = mysqli_query($conn, "SELECT * FROM branch WHERE BranchName LIKE '%$input%' OR District LIKE '%$input%' OR Pincode LIKE '%$input%' OR IFSC LIKE '%$input%'");
                while ($data = mysqli_fetch_assoc($get_branch)) {
                    echo "<p class='branchName'>" . $data['BranchName'] . "</p>";
                }
                ?>
            </div>
        </div>
        <div class="branch-details">
            <table class="styled-table">
                <thead>
                    <th colspan="2">BRANCH DETAILS</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Branch Name</td>
                        <td><?php echo $branchDetails['BranchName'] ?></td>
                    </tr>
                    <tr>
                        <td>IFSC</td>
                        <td><?php echo $branchDetails['IFSC'] ?></td>
                    </tr>
                    <tr>
                        <td>Branch Manager</td>
                        <td><?php echo $branchDetails['BranchManager'] ?></td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td><?php echo $branchDetails['Address'] ?></td>
                    </tr>
                    <tr>
                        <td>District</td>
                        <td><?php echo $branchDetails['District'] ?></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><?php echo $branchDetails['State'] ?></td>
                    </tr>
                    <tr>
                        <td>Pincode</td>
                        <td><?php echo $branchDetails['Pincode'] ?></td>
                    </tr>
                    <tr>
                        <td>Working Hours</td>
                        <td><?php echo $branchDetails['WorkingHours'] ?></td>
                    </tr>
                    <td>Non Working Days</td>
                    <td><?php echo $branchDetails['NonWorkingDays'] ?></td>
                    </tr>
                    <tr>
                        <td>Classification</td>
                        <td><?php echo $branchDetails['Classification'] ?></td>
                    </tr>
                    <tr>
                        <td>Phone No</td>
                        <td><?php echo $branchDetails['Phone'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><?php echo $branchDetails['Email'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved. |
            <a href="/components/extra/about-us.php">About Us</a> |
            <a href="/components/extra/products.php">Services</a> |
            <a href="/components/extra/faqs.php">FAQs</a> |
            <a href="/components/extra/terms-conditions.php">Terms and Conditions</a> |
            <a href="/components/extra/privacy-policy.php">Privacy Policy</a>
        </p>
    </footer>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var branchNames = document.querySelectorAll('.branchName');
            var branchDetailsDiv = document.querySelector('.branch-details');

            branchNames.forEach(function(name) {
                name.addEventListener('click', function() {
                    var branchName = this.textContent.trim();
                    var xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            branchDetailsDiv.innerHTML = this.responseText;
                        }
                    };
                    xhr.open("GET", "/assets/php/get_branch_details.php?branchName=" + branchName, true);
                    xhr.send();
                });
            });
        });
    </script>
</body>

</html>