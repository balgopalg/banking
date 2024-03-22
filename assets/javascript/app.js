window.addEventListener("load", function () {
    var loader = document.getElementById("preloader");
    setTimeout(function () {
        loader.style.display = "none";
    }, 2000);
});



/* signup validation */

document.addEventListener("DOMContentLoaded", function () {
    var page1 = document.getElementById('page1');
    var page2 = document.getElementById('page2');
    var page3 = document.getElementById('page3');
    var page4 = document.getElementById('page4');
    var page5 = document.getElementById('page5');

    var Next1 = document.getElementById('Next1');
    var Next2 = document.getElementById('Next2');
    var Next3 = document.getElementById('Next3');
    var Next4 = document.getElementById('Next4');

    var Back1 = document.getElementById('Back1');
    var Back2 = document.getElementById('Back2');
    var Back3 = document.getElementById('Back3');
    var Back4 = document.getElementById('Back4');

    Next1.onclick = function () {
        if (validatePage1()) {
            page1.style.left = "-450px";
            page2.style.left = "60px";
            progress.style.width = "160px";
        } else {
            var err = document.getElementsByClassName('error-text')[0];
            err.innerText = 'Please fill in all fields with valid information.';
            err.style.display = 'block';
            setTimeout(function () {
                err.style.display = 'none';
            }, 2000);
        }
    }

    Next2.onclick = function () {
        if (validatePage2()) {
            page2.style.left = "-450px";
            page3.style.left = "60px";
            progress.style.width = "240px";
        } else {
            var err = document.getElementsByClassName('error-text')[0];
            err.innerText = 'Please fill in all fields with valid information.';
            err.style.display = 'block';
            setTimeout(function () {
                err.style.display = 'none';
            }, 2000);
        }
    }

    Next3.onclick = function () {
        if (validatePage3()) {
            page3.style.left = "-450px";
            page4.style.left = "60px";
            progress.style.width = "320px";
        } else {
            var err = document.getElementsByClassName('error-text')[0];
            err.innerText = 'Please fill in all fields with valid information.';
            err.style.display = 'block';
            setTimeout(function () {
                err.style.display = 'none';
            }, 2000);
        }
    }

    Next4.onclick = function () {
        if (validatePage4()) {
            page4.style.left = "-450px";
            page5.style.left = "60px";
            progress.style.width = "400px";
        } else {
            var err = document.getElementsByClassName('error-text')[0];
            err.innerText = 'Please fill in all fields with valid information.';
            err.style.display = 'block';
            setTimeout(function () {
                err.style.display = 'none';
            }, 2000);
        }
    }

    function validatePage1() {
        var fullname = document.getElementsByName('fname')[0].value;
        var phone = document.getElementsByName('phoneno')[0].value;
        var aadhaar = document.getElementsByName('aadhaar')[0].value;

        var phoneRegex = /^\d{10}$/;
        var aadhaarRegex = /^\d{12}$/;

        return (
            fullname.trim() !== '' &&
            phone.trim() !== '' && phoneRegex.test(phone) &&
            aadhaar.trim() !== '' && aadhaarRegex.test(aadhaar)
        );
    }


    function validatePage2() {
        var username = document.getElementsByName('uname')[0].value;
        var email = document.getElementsByName('email')[0].value;
        var password = document.getElementsByName('password')[0].value;
        return (username.trim() !== '' && email.trim() !== '' && password.trim() !== '');
    }

    function validatePage3() {
        var address = document.getElementsByName('address')[0].value;
        var pincode = document.getElementById('pincode').value;
        return (address.trim() !== '' && pincode.trim() !== '');
    }

    function validatePage4() {
        return true;
    }

    Back1.onclick = function () {
        page1.style.left = "60px";
        page2.style.left = "450px";
        progress.style.width = "80px";
    }
    Back2.onclick = function () {
        page2.style.left = "60px";
        page3.style.left = "450px";
        progress.style.width = "160px";
    }
    Back3.onclick = function () {
        page3.style.left = "60px";
        page4.style.left = "450px";
        progress.style.width = "240px";
    }
    Back4.onclick = function () {
        page4.style.left = "60px";
        page5.style.left = "450px";
        progress.style.width = "320px";
    }
});