<?php
// register.php

// Database connection details
$host = 'mysql-31c65a70-thomasfortoul0812-417b.g.aivencloud.com';
$port = '11797';
$db   = 'comp307';
$user = 'avnadmin';
$pass = 'AVNS_kM0epupekoMax6jKOg9';
$ca   = __DIR__ . '/ca.pem'; // Path to the SSL CA certificate

// Create the DSN (Data Source Name)
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    // Establish a secure connection with SSL CA
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => $ca,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted email and password
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format');
    }

    // Check if passwords match
    if ($_POST['password'] !== $_POST['confirm-password']) {
        die('Passwords do not match.');
    }

    // Hash the password securely
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Prepare the SQL statement
    $sql = "INSERT INTO Users (Email, PasswordHash, IsLoggedIn) VALUES (:email, :passwordHash, 1)";

    try {
        // Prepare and execute the insert query
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':passwordHash', $passwordHash);
        $stmt->execute();

        // Start a session for the new user
        session_start();
        $_SESSION['user_id'] = $pdo->lastInsertId(); // Get the new user's ID
        $_SESSION['user_name'] = $email; // Use email as username for now

        // Redirect to the dashboard page
        header("Location: /comp307-finalproject/private/dashboard/dashboard.php");
        exit(); // Stop further script execution
    } catch (PDOException $e) {
        // Handle errors like duplicate emails
        if ($e->getCode() == 23000) {
            echo "Email already exists. Please use a different email.";
        } else {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
