<?php
// db.php: Database connection with SSL configuration

$host = 'mysql-31c65a70-thomasfortoul0812-417b.g.aivencloud.com';
$port = '11797';
$db   = 'comp307'; // Make sure to use the correct database name
$user = 'avnadmin';
$pass = 'AVNS_kM0epupekoMax6jKOg9';

// Path to the CA certificate
$ca = realpath(__DIR__ . '/ca.pem');
if (!$ca) {
    die("Error: CA certificate not found.");
}

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";

try {
    // Establish a secure connection with SSL
    $options = [
        PDO::MYSQL_ATTR_SSL_CA => $ca,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable error reporting
    ];
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
