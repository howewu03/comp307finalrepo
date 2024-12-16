<?php
session_start();
include 'db.php'; // Include database connection

if (isset($_SESSION['user_id'])) {
    $userID = $_SESSION['user_id'];
    error_log("Session UserID: " . $userID);

    try {
        // Update `IsLoggedIn` field
        $updateStmt = $pdo->prepare("UPDATE Users SET IsLoggedIn = 0 WHERE UserID = ?");
        $result = $updateStmt->execute([$userID]);

        // Check if update was successful
        if ($result && $updateStmt->rowCount() > 0) {
            error_log("IsLoggedIn updated successfully for UserID: " . $userID);
        } else {
            error_log("IsLoggedIn update failed for UserID: " . $userID);
        }
    } catch (PDOException $e) {
        error_log("Error executing query: " . $e->getMessage());
    }

    // Destroy session
    session_unset();
    session_destroy();
    error_log("Session destroyed for UserID: " . $userID);
}

// Redirect to landing page
header("Location: /comp307-finalproject/public/landing/landingpage.html");
exit();
?>
