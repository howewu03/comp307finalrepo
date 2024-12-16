<?php
//checks if user is logged in, if not redirect to landing page if trying to access private pages
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /comp307-finalproject/public/landing/landingpage.html");
    exit();
}
?>
