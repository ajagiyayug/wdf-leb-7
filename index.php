<?php session_start(); ?>
<!DOCTYPE html> 
<html lang="en"> 
<head> 
  <meta charset="UTF-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
  <title>Register - StudentHub</title> 
  <link rel="stylesheet" href="assets/css/style.css"> 
  <style>
    .server-msg { padding: 10px; margin-bottom: 15px; border-radius: 4px; font-weight: bold; }
    .server-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .server-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
    .server-error ul { margin: 0; padding-left: 20px; }
  </style>
  <script>
    if (localStorage.getItem('theme') === 'dark') {
      document.documentElement.classList.add('dark-theme');
    }
  </script>
</head> 
<body class="auth-body"> 
  <div class="card auth-card"> 
    <h2 class="auth-title">Student Registration</h2> 
     
    <!-- Display Success Message -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="server-msg server-success">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <!-- Display Validation Errors -->
    <?php if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])): ?>
        <div class="server-msg server-error">
            <ul>
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php unset($_SESSION['errors']); ?>
    <?php endif; ?>

    <!-- Form Action & Method Set to POST -->
    <form id="register-form" action="process.php" method="POST" novalidate> 
       
      <!-- Full Name --> 
      <div class="form-group"> 
        <label for="fullName">Full Name</label> 
        <input type="text" id="fullName" name="fullName" class="form-control" placeholder="John Doe"> 
        <span class="error-msg" id="nameError">Name must be at least 3 characters long (letters only).</span> 
      </div> 
 
      <!-- Email Address --> 
      <div class="form-group"> 
        <label for="email">Email Address</label> 
        <input type="email" id="email" name="email" class="form-control" placeholder="example@domain.com"> 
        <span class="error-msg" id="emailError">Please enter a valid email address.</span> 
      </div> 
 
      <!-- Mobile Number --> 
      <div class="form-group"> 
        <label for="mobile">Mobile Number</label> 
        <input type="tel" id="mobile" name="mobile" class="form-control" placeholder="10-digit mobile number"> 
        <span class="error-msg" id="mobileError">Please enter a valid 10-digit mobile number.</span> 
      </div> 
 
      <!-- Gender --> 
      <div class="form-group"> 
        <label>Gender</label> 
        <div class="radio-group"> 
          <label class="radio-label"><input type="radio" name="gender" value="Male"> Male</label> 
          <label class="radio-label"><input type="radio" name="gender" value="Female"> Female</label> 
          <label class="radio-label"><input type="radio" name="gender" value="Other"> Other</label> 
        </div> 
        <span class="error-msg" id="genderError">Please select your gender.</span> 
      </div> 
 
      <!-- Course & Year (Row) --> 
      <div class="form-row"> 
        <div class="form-group"> 
          <label for="course">Course</label> 
          <select id="course" name="course" class="form-control"> 
            <option value="">-- Select Course --</option> 
            <option value="B.Tech">B.Tech</option>
            <option value="M.Tech">M.Tech</option>
            <option value="B.Sc">B.Sc</option>
            <option value="M.Sc">M.Sc</option>
            <option value="BCA">BCA</option>
            <option value="MCA">MCA</option>
          </select>
          <span class="error-msg" id="courseError">Select a course.</span>
        </div>
 
        <div class="form-group">
          <label for="year">Year of Study</label>
          <select id="year" name="year" class="form-control">
            <option value="">-- Select Year --</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
          </select>
          <span class="error-msg" id="yearError">Select year.</span>
        </div>
      </div>
 
      <!-- Password -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="••••••••">
        <div class="strength-meter-container">
          <div class="strength-meter-bar" id="strengthBar"></div>
        </div>
        <small class="strength-text" id="strengthText"></small>
        <span class="error-msg" id="passwordError">Min 8 chars, 1 uppercase, 1 number & 1 special char required.</span>
      </div>
 
      <!-- Confirm Password --> 
      <div class="form-group">
        <label for="confirmPassword">Confirm Password</label>
        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control" placeholder="••••••••">
        <span class="error-msg" id="confirmPasswordError">Passwords do not match.</span>
      </div>
 
      <!-- Terms Acceptance -->
      <div class="form-group">
        <label class="checkbox-label">
          <input type="checkbox" id="terms" name="terms" value="1">
          I accept the Terms and Conditions 
        </label>
        <span class="error-msg" id="termsError">You must accept the terms to register.</span>
      </div>
 
      <button type="submit" class="btn btn-primary btn-block">Register</button>
    </form>
 
    <p class="auth-footer-text">
      Already have an account? <a href="login.html" class="auth-link">Login here</a> | 
      <a href="display.php" class="auth-link">View Registered Data</a>
    </p>
  </div>
 
  <script src="assets/js/script.js"></script>
</body>
</html>