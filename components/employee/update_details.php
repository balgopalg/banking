<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'] . "/assets/php/config.php";
if (isset($_POST['changepass'])) {
    $accountNo = $_SESSION['customerAccountNo'];
    $password = $_POST['password'];
    $encrypt_password = md5($password);
    if (mysqli_query($conn, "UPDATE customers SET Password='$encrypt_password' WHERE AccountNo=$accountNo")) {
        echo "<script>alert('Password changed successfully')
        window.history.back();
        </script>";
    }
}

if (isset($_POST['updatepic'])) {
    // , $_SESSION['customerAccountNo'], $_FILES['image']
    $accountNo = $_SESSION['customerAccountNo'];
    $img = $_FILES['image'];

    $allowed_extensions = ["jpeg", "png", "jpg"];
    $img_ext = strtolower(pathinfo($img['name'], PATHINFO_EXTENSION));

    if (in_array($img_ext, $allowed_extensions) && $img['error'] === UPLOAD_ERR_OK) {

        $prev_image_query = mysqli_query($conn, "SELECT `img` FROM customers WHERE AccountNo='$accountNo'");

        if ($prev_image_query && mysqli_num_rows($prev_image_query) > 0) {
            $prev_image_row = mysqli_fetch_assoc($prev_image_query);
            $prev_image_name = $prev_image_row['img'];

            $prev_image_path = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $prev_image_name;
            if (file_exists($prev_image_path)) {
                unlink($prev_image_path);
            }
        }

        $upload_directory = "bms/images/";
        $new_img_name = time() . "_" . $img['name'];
        $destination = $_SERVER['DOCUMENT_ROOT'] . "/" . $upload_directory . $new_img_name;

        if (move_uploaded_file($img['tmp_name'], $destination)) {
            $query = "UPDATE customers SET `img`='$new_img_name' WHERE AccountNo='$accountNo'";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Image uploaded successfully'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
                exit();
            } else {
                echo "Failed to update image in the database.";
            }
        } else {
            echo "Failed to move uploaded file.";
        }
    } else {
        echo "Invalid file format or an error occurred during upload.";
    }
}


if (isset($_POST['deleteAccount'])) {
    $accountNo = $_SESSION['customerAccountNo'];

    if (mysqli_num_rows(mysqli_query($conn, "SELECT COUNT(*) FROM loanapp WHERE customerAccountNo=$accountNo")) > 0) {
        echo "<script>alert('Customer have active loan . '); 
        window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit;
    } else {

        $prev_image_query = mysqli_query($conn, "SELECT `img` FROM customers WHERE AccountNo='$accountNo'");

        if ($prev_image_query && mysqli_num_rows($prev_image_query) > 0) {
            $prev_image_row = mysqli_fetch_assoc($prev_image_query);
            $prev_image_name = $prev_image_row['img'];

            $prev_image_path = $_SERVER['DOCUMENT_ROOT'] . "/images/" . $prev_image_name;
            if (file_exists($prev_image_path)) {
                unlink($prev_image_path);
            }
        }


        if (mysqli_query($conn, "DELETE FROM customers WHERE AccountNo=$accountNo")) {
            echo "<script>alert('Account Deleted Successfully');
        window.location.href = '/components/employee/clerk_dashboard.php';
        </script>";
            exit;
        }
    }
}

if (isset($_POST['active'])) {
    $accountNo = $_SESSION['customerAccountNo'];
    if (mysqli_query($conn, "UPDATE customers SET Status='Active' WHERE AccountNo=$accountNo")) {
        echo "<script>alert('Account Marked active'); 
        window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit;
    }
}

if (isset($_POST['inactive'])) {
    $accountNo = $_SESSION['customerAccountNo'];
    if (mysqli_query($conn, "UPDATE customers SET Status='Inactive' WHERE AccountNo=$accountNo")) {
        echo "<script>alert('Account Marked inactive'); 
        window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit;
    }
}

if (isset($_POST['submit'])) {
    $accountno = $_SESSION['customerAccountNo'];
    $name = $_POST['fname'];
    $username = $_POST['uname'];
    $email = $_POST['email'];
    $gender = strtolower($_POST['gender']);
    $phoneno = $_POST['phoneno'];
    $address = $_POST['address'];
    $district = $_POST['district'];
    $state = $_POST['state'];
    $pincode = $_POST['pincode'];
    $ifsc = $_POST['ifsc'];
    $aadhaar = $_POST['aadhaar'];

    if (mysqli_query($conn, "UPDATE `customers` SET `FullName`='$name',`UserName`='$username',`PhoneNo`='$phoneno',`Email`='$email',`gender`='$gender',`Address`='$address',`District`='$district',`State`='$state',`Pincode`='$pincode',`AadhaarNo`='$aadhaar',`IFSC`='$ifsc' WHERE `AccountNo` = '$accountno'")) {
        echo "<script>alert('Updated successfully'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to update. Please try again.');</script>";
    }
}
