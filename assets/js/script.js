document.addEventListener('DOMContentLoaded', function () {
  
  // Theme check from LocalStorage
  if (localStorage.getItem('theme') === 'dark') {
    document.documentElement.classList.add('dark-theme');
  }

  const password = document.getElementById('password');
  const strengthBar = document.getElementById('strengthBar');
  const strengthText = document.getElementById('strengthText');

  // Live Password Strength Indicator
  if (password && strengthBar && strengthText) {
    password.addEventListener('input', () => {
      const val = password.value;
      let strength = 0;

      if (val.length >= 8) strength++;
      if (/[A-Z]/.test(val)) strength++;
      if (/[0-9]/.test(val)) strength++;
      if (/[^A-Za-z0-9]/.test(val)) strength++;

      switch (strength) {
        case 0:
        case 1:
          strengthBar.style.width = '25%';
          strengthBar.style.backgroundColor = 'red';
          strengthText.innerText = 'Weak';
          break;
        case 2:
        case 3:
          strengthBar.style.width = '60%';
          strengthBar.style.backgroundColor = 'orange';
          strengthText.innerText = 'Medium';
          break;
        case 4:
          strengthBar.style.width = '100%';
          strengthBar.style.backgroundColor = 'green';
          strengthText.innerText = 'Strong';
          break;
      }
    });
  }
});