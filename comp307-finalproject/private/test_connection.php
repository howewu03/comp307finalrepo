<?php
include 'db.php'; // Include the database connection script

// Test a simple query
try {
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<h2>Tables in the Database:</h2>";
    foreach ($tables as $table) {
        echo "<p>" . implode(', ', $table) . "</p>";
    }
} catch (PDOException $e) {
    echo "Error querying the database: " . $e->getMessage();
}
?>
