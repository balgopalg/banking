<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">
</head>
<?php
session_start();
if ($_SESSION["isLoggedin"] == false) {
    header('location:/index.php');
}
require $_SERVER['DOCUMENT_ROOT'] ."/assets/php/config.php";
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
    <main style="height: 400px; overflow-y:auto;">
        <div class="banner">
            <h3>Support</h3>
        </div>
        <div class="help-main">
            <?php
            $get_contactus = mysqli_query($conn, "SELECT * FROM contactus");
            if (mysqli_num_rows($get_contactus) > 0) {
                while ($row = mysqli_fetch_assoc($get_contactus)) {
                    echo '<div class="help-container">
                <div class="user-details">
                    <div class="usr">
                        <h4>Name : ' . $row['name'] . '</h4>
                        <h4>Phoneno : ' . $row['phoneno'] . '</h4>
                    </div>
                    <form method="post">
                    <input type="number" name="id" value="'.$row['ID'].'" hidden>
                    <button name="delete">Delete</button>
                    </form>
                </div>
                <div class="user-message">
                    <div>
                        <h3>' . $row['subject'] . '</h3>
                    </div>
                    <div>
                        <p>' . $row['message'] . '</p>
                    </div>
                </div>
            </div>';
                }
            } else {
                echo "no record found";
            }

            ?>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.
        </p>
    </footer>
</body>
</html>

<?php
if(isset($_POST['delete'])){
    $id=$_POST['id'];
    if(mysqli_query($conn,"DELETE FROM contactus WHERE ID=$id")){
        echo "<script>alert('Message Deleted'); window.location.href = '" . $_SERVER['HTTP_REFERER'] . "';</script>";
        exit();
    }
}

?>