<?php
//koneksi ke db
require_once __DIR__ . "/connection1.php";

//membuat tombol untuk tambah photo 
echo "<a href='form_upload.php'><button>Tambah Data</button></a><br><br>";

$sql = "SELECT * FROM photo";
// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Process the result set
if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    echo "<table border=1 cellpadding=5px";
    echo "<caption><strong>Daftar Foto</strong></caption?";
    echo "<tr>";
    echo "<th>No</th>";
    echo "<th>Nama File</th>";
    echo "<th>Tgl Unggah</th>";
    echo "<th>Pratinjau</th>";
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_photo'] . "</td>";
        echo "<td>" . $row['file_name'] . "</td>";
        echo "<td>" . $row['uploaded_date'] . "</td>";
        echo "<td><img src =" . $row['file_name'] . " width='150px' height='auto'></td>";
        echo "<tr>";
    }
    echo "</table>";
} else {
    echo "0 results - Data not found!";
}

mysqli_close($conn);
?>