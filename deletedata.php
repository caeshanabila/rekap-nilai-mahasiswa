<?php
require_once __DIR__ . "/connection1.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nim = $_POST["nim"] ?? "";

    if ($nim !== "") {
        $sql = "DELETE FROM nilaimhsw WHERE nim = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $nim);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

mysqli_close($conn);
header("Location: viewdata.php");
exit;
?>