<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
        function disableEnterKey(e) {
            var keycode = (e.keyCode ? e.keyCode : e.which);
            if (keycode == 13) {
                e.preventDefault();
                return false;
            }
        }
    </script>
    <script src="assets/javascript/app.js"></script>
</head>
<?php
require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
?>

<body style="flex-direction: column;">
    <nav class="navbar login-page">
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
        <div class="dropdown login-page">
            <span class="material-symbols-outlined users">account_circle</span>
            <div class="items">
                <a href="customer_login.php">Customer</a>
                <a href="employee_login.php">Staff</a>
                <a href="admin_login.php">Admin</a>
            </div>
        </div>
    </div>
    <style>
        .wrapper {
            width: 400px;
            min-height: 500px;
            margin: 10px auto;
            background-color: #101820;
            position: relative;
            overflow: hidden;
        }

        input[type="submit"] {
            /* background: linear-gradient(to right, #ff105f, #ffad06); */
            background: linear-gradient(to right, #da00ff, #008fff);
        }
    </style>
    <main class="clogin-main">
        <div class="wrapper">
            <section class="form signup">
                <form action="" method="post" enctype="multipart/form-data" onkeypress="return disableEnterKey(event)" autocomplete="off">
                    <div class="page" id="page1">
                        <div class="error-text"></div>
                        <h3>Personal Information</h3>
                        <br>
                        <div class="field input">
                            <label>Fullname</label>
                            <input type="text" name="fname" placeholder="Full name">
                        </div>
                        <div class="field input">
                            <label>Phone no</label>
                            <input type="text" name="phoneno" placeholder="Enter your phone no" pattern="[0-9]{10}" maxlength="10">
                        </div>
                        <div class="field input">
                            <label>Gender</label>
                            <select name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="field input">
                            <label>Aadhaar No</label>
                            <input type="text" name="aadhaar" placeholder="Enter your Aadhaar no" pattern="[0-9]{12}" maxlength="12">
                        </div>
                        <div class="btn-box">
                            <button type="button" id="Next1">Next</button>
                        </div>
                    </div>
                    <div class="page" id="page2">
                        <div>
                            <h3>Account Information</h3>
                            <br>
                            <div class="field input">
                                <label>Username</label>
                                <input type="text" name="uname" placeholder="Username">
                            </div>
                            <div class="field input">
                                <label>Email Address</label>
                                <input type="text" name="email" placeholder="Enter your email">
                            </div>
                            <div class="field input">
                                <label>Password</label>
                                <input type="password" name="password" placeholder="Enter your password" required>
                                <i class="fas fa-eye"></i>
                            </div>
                            <script src="/assets/javascript/pass-show-hide.js"></script>
                        </div>
                        <div class="btn-box">
                            <button type="button" id="Back1">Previous</button>
                            <button type="button" id="Next2">Next</button>
                        </div>
                    </div>
                    <div class="page" id="page3">
                        <h3>Address</h3>
                        <br>
                        <div class="field input">
                            <label>Address</label>
                            <input type="text" name="address" placeholder="Enter your address">
                        </div>
                        <div class="field input">
                            <label>Pincode</label>
                            <input type="text" name="pincode" id="pincode" placeholder="Enter your Pincode" pattern="[0-9]{6}" maxlength="6">
                        </div>
                        <div class="field input">
                            <label>District</label>
                            <input type="text" name="district" id="district" placeholder="Enter your District" readonly>
                        </div>
                        <div class="field input">
                            <label>State</label>
                            <input type="text" name="state" id="state" placeholder="Enter your State" readonly>
                        </div>
                        <script>
                            async function lookupPincode() {
                                const pincode = document.getElementById('pincode').value;
                                const response = await fetch(`/assets/php/lookup.php?code=${pincode}`);
                                const data = await response.json();
                                if (data.district && data.state) {
                                    document.getElementById('district').value = data.district;
                                    document.getElementById('state').value = data.state;
                                } else {
                                    alert('Invalid PIN code');
                                }
                            }
                            document.getElementById('pincode').addEventListener('blur', lookupPincode);
                        </script>
                        <div class="btn-box">
                            <button type="button" id="Back2">Previous</button>
                            <button type="button" id="Next3">Next</button>
                        </div>
                    </div>
                    <div class="page" id="page4">
                        <div>
                            <h3>Choose your branch</h3>
                            <br>
                            <div class="field input">
                                <label>Choose branch</label>
                                <select name="branch" id="branch">
                                    <?php
                                    $get_branch = mysqli_query($conn, "SELECT * FROM branch");
                                    while ($branch = mysqli_fetch_assoc($get_branch)) {
                                        echo "<option value='" . $branch['IFSC'] . "'>" . $branch['Pincode'] . " - " . $branch['BranchName']   . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <br>
                            <h3>Upload your Image</h3>
                            <br>
                            <div class="field image">
                                <label>Select Image</label>
                                <input type="file" name="image" accept="image/x-png,image/gif,image/jpeg,image/jpg">
                            </div>
                        </div>
                        <div class="btn-box">
                            <button type="button" id="Back3">Previous</button>
                            <button type="button" id="Next4">Next</button>
                        </div>
                    </div>
                    <div class="page" id="page5">
                        <div>
                            <h3> Confirmation</h3>
                            <br>
                            <p> Please review your information before submitting.</p>
                        </div>
                        <div class="field button">
                            <div class="btn-box">
                                <button type="button" id="Back4">Previous</button>
                            </div>
                            <input type="submit" name="submit" value="Submit Form" style="background:linear-gradient(to right, #ff105f, #ffad06);">
                        </div>
                    </div>
                </form>
            </section>
        </div>
        <div class="step-row">
            <div id="progress"></div>
            <div class="step-col"><small>1</small></div>
            <div class="step-col"><small>2</small></div>
            <div class="step-col"><small>3</small></div>
            <div class="step-col"><small>4</small></div>
            <div class="step-col"><small>5</small></div>
        </div>
    </main>

    <footer class="login-page">
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved. |
            <a href="/about">About Us</a> |
            <a href="/services">Services</a> |
            <a href="/faq">FAQs</a> |
            <a href="/terms">Terms and Conditions</a> |
            <a href="/privacy">Privacy Policy</a>
        </p>
    </footer>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
    require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $uname = strtolower(mysqli_real_escape_string($conn, $_POST['uname']));
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = strtolower(mysqli_real_escape_string($conn, $_POST['email']));
    $phoneno = mysqli_real_escape_string($conn, $_POST['phoneno']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $district = mysqli_real_escape_string($conn, $_POST['district']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $aadhaarno = mysqli_real_escape_string($conn, $_POST['aadhaar']);
    $branch = strtoupper(mysqli_real_escape_string($conn, $_POST['branch']));

    if (!empty($fname) && !empty($uname)  && !empty($password) && !empty($email) && !empty($phoneno)  && !empty($gender) && !empty($address) && !empty($district) && !empty($state)  && !empty($pincode) && !empty($aadhaarno && !empty($branch))) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $sql = mysqli_query($conn, "SELECT * FROM customers WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) {
                $err = "$email - This email already exist!";
            } else {
                if (isset($_FILES['image'])) {
                    $img_name = $_FILES['image']['name'];
                    $img_type = $_FILES['image']['type'];
                    $tmp_name = $_FILES['image']['tmp_name'];

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);

                    $extensions = ["jpeg", "png", "jpg"];
                    if (in_array($img_ext, $extensions) === true) {
                        $types = ["image/jpeg", "image/jpg", "image/png"];
                        if (in_array($img_type, $types) === true) {
                            $time = time();
                            $new_img_name = $time . $img_name;
                            if (move_uploaded_file($tmp_name, "images/" . $new_img_name)) {
                                $encrypt_pass = md5($password);
                                $insert_query = mysqli_query($conn, "INSERT INTO `customers` (`FullName`, `UserName`, `Password`, `Email`, `PhoneNo`,`gender`, `Address`, `District`, `State`, `Pincode`,`AadhaarNo`, `img`,`IFSC`) VALUES ('{$fname}', '{$uname}', '{$encrypt_pass}', '{$email}', '{$phoneno}','{$gender}', '{$address}', '{$district}', '{$state}', '{$pincode}','{$aadhaarno}', '{$new_img_name}','{$branch}')");
                                if ($insert_query) {
                                    echo "<script>alert('Application received');</script>";
                                } else {
                                    $err = "Something went wrong. Please try again!";
                                }
                            }
                        } else {
                            $err = "Please upload an image file - jpeg, png, jpg";
                        }
                    } else {
                        $err = "Please upload an image file - jpeg, png, jpg";
                    }
                }
            }
        } else {
            $err = "$email is not a valid email!";
        }
    } else {
        $err = "All input fields are required!";
    }
}

if (isset($err)) {
    echo "<script>var err = document.getElementsByClassName('error-text')[0];
        err.innerText = '$err';
        err.style.display='block';
        </script>";
}
?>