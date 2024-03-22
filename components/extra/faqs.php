<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank of Bhadrak - FAQs</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="./assets/app.js"></script>
    <link rel="stylesheet" href="style.css">
    <?php
    require_once $_SERVER['DOCUMENT_ROOT'] . "/assets/php/prac.php";
    ?>
</head>

<body>
    <nav class="navbar">
        <div class="top-nav">
            <div>
                <a href="#">
                    <img src="/images/logo.jpg" alt="">
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
        <a href="javascript:history.back()"><button class="back-button">&larr;</button></a>
    </div>
    <div class="banner">
        <h2>FAQs (Frequently Asked Questions) </h2>
    </div>
    <main class="accordian-main">
        <div class="accordian">
            <div class="question">
                <h4>Who is eligible to open an account with Bank of Bhadrak?</h4>
                <i class="icon fa-solid fa-caret-down"></i>
            </div>
            <div class="answer">
                <p>Any individual or organization meeting our account opening criteria can open an account with us.</p>
            </div>
        </div>
        <div class="accordian">
            <div class="question">
                <h4>How can I apply for a loan?</h4>
                <i class="icon fa-solid fa-caret-down"></i>
            </div>
            <div class="answer">
                <p>You can apply for a loan by visiting any of our branches or by filling out an online application form on our website.</p>
            </div>
        </div>
        <div class="accordian">
            <div class="question">
                <h4>What are the interest rates offered by Bank of Bhadrak?</h4>
                <i class="icon fa-solid fa-caret-down"></i>
            </div>
            <div class="answer">
                <p>Our interest rates vary depending on the type of account or loan. You can find our current rates on our website or by contacting our customer service.</p>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const accordians = document.querySelectorAll('.accordian');
            accordians.forEach(accordion => {
                const icon = accordion.querySelector('.icon');
                const answer = accordion.querySelector('.answer');
                accordion.addEventListener("click", () => {
                    if (icon.classList.contains('active')) {
                        icon.classList.remove('active');
                        answer.style.maxHeight = null;
                    } else {
                        icon.classList.add('active');
                        answer.style.maxHeight = answer.scrollHeight + "px";
                    }
                });
            });
        });
    </script>

    <footer>
        <p>&copy; 2024 Bank of Bhadrak. All rights reserved.</p>
    </footer>
</body>

</html>