<?php
// connect to db server
require_once __DIR__ . "/connection1.php";

// sql to create table
$sql = "CREATE TABLE nilaimhsw (
nim CHAR(10) PRIMARY KEY,
namalengkap VARCHAR(50) NOT NULL,
nilaiakhir DECIMAL(5,2) NOT NULL,
nilaihuruf CHAR(1),
predikat VARCHAR(20),
created_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
modified_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (mysqli_query($conn, $sql)) {
    echo "Table created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}

mysqli_close($conn);
?>