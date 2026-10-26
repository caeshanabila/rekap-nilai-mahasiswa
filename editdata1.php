<?php
require_once __DIR__ . "/connection1.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Metode permintaan tidak valid.");
}

// Mengambil data dari form Edit
$nimLama = trim($_POST["nim_lama"] ?? "");
$nimBaru = trim($_POST["nim_baru"] ?? "");
$namalengkap = trim($_POST["namalengkap"] ?? "");
$nilaiInput = $_POST["nilaiakhir"] ?? "";

if (
    $nimLama === "" ||
    $nimBaru === "" ||
    strlen($nimBaru) !== 10 ||
    $namalengkap === "" ||
    $nilaiInput === "" ||
    !is_numeric($nilaiInput) ||
    (float)$nilaiInput < 0 ||
    (float)$nilaiInput > 100
) {
    exit("Data tidak valid. Periksa kembali NIM, nama, dan nilai.");
}

$nilaiakhir = (float)$nilaiInput;

// Menentukan nilai huruf dan predikat
if ($nilaiakhir <= 34.50) {
    $nilaihuruf = "E";
    $predikat = "Tidak Lulus";
} elseif ($nilaiakhir <= 50.50) {
    $nilaihuruf = "D";
    $predikat = "Kurang Memuaskan";
} elseif ($nilaiakhir <= 60.50) {
    $nilaihuruf = "C";
    $predikat = "Cukup Memuaskan";
} elseif ($nilaiakhir <= 80.50) {
    $nilaihuruf = "B";
    $predikat = "Memuaskan";
} else {
    $nilaihuruf = "A";
    $predikat = "Sangat Memuaskan";
}

// Mengambil foto lama dari database
$stmtFoto = mysqli_prepare(
    $conn,
    "SELECT foto FROM nilaimhsw WHERE nim = ?"
);

mysqli_stmt_bind_param($stmtFoto, "s", $nimLama);
mysqli_stmt_execute($stmtFoto);
$resultFoto = mysqli_stmt_get_result($stmtFoto);
$dataFoto = mysqli_fetch_assoc($resultFoto);
mysqli_stmt_close($stmtFoto);

if (!$dataFoto) {
    exit("Data mahasiswa tidak ditemukan.");
}

$foto = $dataFoto["foto"] ?? "";
$targetFileBaru = null;

// Upload foto jika pengguna memilih foto baru
if (
    isset($_FILES["foto"]) &&
    $_FILES["foto"]["error"] !== UPLOAD_ERR_NO_FILE
) {
    if ($_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
        exit("Foto gagal diunggah.");
    }

    if ($_FILES["foto"]["size"] > 2000000) {
        exit("Ukuran foto maksimal 2 MB.");
    }

    $check = getimagesize($_FILES["foto"]["tmp_name"]);

    if ($check === false) {
        exit("File yang dipilih bukan gambar.");
    }

    $formatDiizinkan = [
        "image/jpeg" => "jpg",
        "image/png" => "png"
    ];

    $mime = $check["mime"];

    if (!isset($formatDiizinkan[$mime])) {
        exit("Format foto harus JPG, JPEG, atau PNG.");
    }

    $folderFoto = __DIR__ . "/img/";

    if (!is_dir($folderFoto)) {
        exit("Folder img tidak ditemukan.");
    }

    // Nama file foto
    $ekstensi = $formatDiizinkan[$mime];
    $namaFotoBaru = $nimBaru . "_" . time() . "." . $ekstensi;
    $targetFileBaru = $folderFoto . $namaFotoBaru;

    if (!move_uploaded_file(
        $_FILES["foto"]["tmp_name"],
        $targetFileBaru
    )) {
        exit("Gagal menyimpan foto.");
    }

    $foto = $namaFotoBaru;
}

// Memperbarui data mahasiswa, bukan menambahkan data baru
$sql = "UPDATE nilaimhsw
        SET nim = ?,
            namalengkap = ?,
            nilaiakhir = ?,
            nilaihuruf = ?,
            predikat = ?,
            foto = ?,
            modified_date = CURRENT_TIMESTAMP
        WHERE nim = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    if ($targetFileBaru !== null && file_exists($targetFileBaru)) {
        unlink($targetFileBaru);
    }

    exit("Gagal menyiapkan query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssdssss",
    $nimBaru,
    $namalengkap,
    $nilaiakhir,
    $nilaihuruf,
    $predikat,
    $foto,
    $nimLama
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: viewdata.php");
    exit;
}

$error = mysqli_stmt_error($stmt);

if ($targetFileBaru !== null && file_exists($targetFileBaru)) {
    unlink($targetFileBaru);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

if (strpos($error, "Duplicate entry") !== false) {
    exit("NIM baru sudah digunakan mahasiswa lain.");
}

exit("Gagal memperbarui data: " . htmlspecialchars($error));
?>
