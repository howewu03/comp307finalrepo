<?php


session_start();
include 'db.php';



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve email and password from POST data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format.');
    }

    try {
        // Fetch user data from the database
        $stmt = $pdo->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and the password is correct
        if ($user && password_verify($password, $user['PasswordHash'])) {
            // Login successful - set session variables
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['email'] = $user['Email'];

            // Update the `is_logged_in` column to 1
            $updateStmt = $pdo->prepare("UPDATE Users SET IsLoggedIn = 1 WHERE UserID = ?");
            $updateStmt->execute([$user['UserID']]);



            // Redirect to the dashboard
            header("Location: /comp307-finalproject/private/dashboard/dashboard.php");
            exit();
        } else {
            // Invalid credentials
            echo "Invalid email or password.";
        }
    } catch (PDOException $e) {
        // Handle database errors
        die("Database error: " . $e->getMessage());
    }
} else {
    // Redirect if accessed without POST
    header("Location: /comp307-finalproject/public/landing/login_form.html");
    exit();
}
?>
