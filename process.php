<?php
session_start();

// 1. Is the form submitted using POST?
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$errors = [];

// 2. Extract and Sanitize Inputs
$fullName        = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
$email           = isset($_POST['email']) ? trim($_POST['email']) : '';
$mobile          = isset($_POST['mobile']) ? trim($_POST['mobile']) : '';
$gender          = isset($_POST['gender']) ? trim($_POST['gender']) : '';
$course          = isset($_POST['course']) ? trim($_POST['course']) : '';
$year            = isset($_POST['year']) ? trim($_POST['year']) : '';
$password        = isset($_POST['password']) ? $_POST['password'] : '';
$confirmPassword = isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '';
$terms           = isset($_POST['terms']) ? true : false;

// Sanitization
$fullName = filter_var($fullName, FILTER_SANITIZE_SPECIAL_CHARS);
$email    = filter_var($email, FILTER_SANITIZE_EMAIL);
$mobile   = filter_var($mobile, FILTER_SANITIZE_NUMBER_INT);
$gender   = filter_var($gender, FILTER_SANITIZE_SPECIAL_CHARS);
$course   = filter_var($course, FILTER_SANITIZE_SPECIAL_CHARS);
$year     = filter_var($year, FILTER_SANITIZE_SPECIAL_CHARS);

// Server-Side Validation
if (empty($fullName) || strlen($fullName) < 3 || !preg_match("/^[a-zA-Z\s]+$/", $fullName)) {
    $errors[] = "Full Name must be at least 3 characters long (letters only).";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Please enter a valid email address.";
}

if (empty($mobile) || !preg_match('/^[0-9]{10}$/', $mobile)) {
    $errors[] = "Please enter a valid 10-digit mobile number.";
}

if (empty($gender)) {
    $errors[] = "Please select your gender.";
}

if (empty($course)) {
    $errors[] = "Please select a course.";
}

if (empty($year)) {
    $errors[] = "Please select year of study.";
}

// Password Validation: Min 8 chars, 1 uppercase, 1 number, 1 special char
$passwordRegex = '/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
if (empty($password) || !preg_match($passwordRegex, $password)) {
    $errors[] = "Password must be min 8 chars with 1 uppercase, 1 number, and 1 special char.";
}

if ($password !== $confirmPassword) {
    $errors[] = "Passwords do not match.";
}

if (!$terms) {
    $errors[] = "You must accept the Terms and Conditions.";
}

// Handle Errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header('Location: index.php');
    exit();
}

// 3. Safe File Writing (JSON Storage)
$dir = __DIR__ . '/data';
$filePath = $dir . '/users.json';

if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$newUser = [
    'id'           => 'STU' . time(),
    'fullName'     => $fullName,
    'email'        => $email,
    'mobile'       => $mobile,
    'gender'       => $gender,
    'course'       => $course,
    'year'         => $year,
    'passwordHash' => password_hash($password, PASSWORD_DEFAULT),
    'submittedAt'  => date('Y-m-d H:i:s')
];

$existingUsers = [];
if (file_exists($filePath)) {
    $jsonContent = file_get_contents($filePath);
    $existingUsers = json_decode($jsonContent, true) ?? [];
}

$existingUsers[] = $newUser;

// Save file with Lock
if (file_put_contents($filePath, json_encode($existingUsers, JSON_PRETTY_PRINT), LOCK_EX) !== false) {
    $_SESSION['success'] = "Registration successful! Record stored safely in JSON.";
} else {
    $_SESSION['errors'] = ["Failed to save data. Please try again."];
}

header('Location: index.php');
exit();