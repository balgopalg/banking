var passwordInputs = document.querySelectorAll('.field input[type="password"]');
var eyeIcons = document.querySelectorAll('.field i');

eyeIcons.forEach(function (eyeIcon, index) {
  eyeIcon.addEventListener('click', function () {
    var passwordInput = passwordInputs[index];
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
    }
  });
});
