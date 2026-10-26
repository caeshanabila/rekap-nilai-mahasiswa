
<?php
require_once __DIR__ . "/connection1.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Metode permintaan tidak valid.");
}

// Mengambil data dari form
$nim = trim($_POST["nim"] ?? "");
$namalengkap = trim($_POST["namalengkap"] ?? "");
$nilaiInput = $_POST["nilaiakhir"] ?? "";

if (
    $nim === "" ||
    strlen($nim) !== 10 ||
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

// Memeriksa apakah NIM sudah terdaftar
$stmtCek = mysqli_prepare(
    $conn,
    "SELECT nim FROM nilaimhsw WHERE nim = ?"
);

mysqli_stmt_bind_param($stmtCek, "s", $nim);
mysqli_stmt_execute($stmtCek);
mysqli_stmt_store_result($stmtCek);

if (mysqli_stmt_num_rows($stmtCek) > 0) {
    mysqli_stmt_close($stmtCek);
    mysqli_close($conn);
    exit("NIM sudah terdaftar. Gunakan NIM yang berbeda.");
}

mysqli_stmt_close($stmtCek);

// Nilai awal foto
$nama_foto = "";
$target_file = null;

// Upload foto jika dipilih
if (
    isset($_FILES["foto"]) &&
    $_FILES["foto"]["error"] !== UPLOAD_ERR_NO_FILE
) {
    if ($_FILES["foto"]["error"] !== UPLOAD_ERR_OK) {
        exit("Terjadi kesalahan saat mengunggah foto.");
    }

    // Validasi ukuran foto maksimal 2 MB
    if ($_FILES["foto"]["size"] > 2000000) {
        exit("Ukuran foto maksimal 2 MB.");
    }

    // Memastikan file benar-benar gambar
    $check = getimagesize($_FILES["foto"]["tmp_name"]);

    if ($check === false) {
        exit("File yang dipilih bukan gambar.");
    }

    // Memvalidasi format gambar
    $formatDiizinkan = [
        "image/jpeg" => "jpg",
        "image/png" => "png"
    ];

    $mime = $check["mime"];

    if (!isset($formatDiizinkan[$mime])) {
        exit("Format foto harus JPG, JPEG, atau PNG.");
    }

    // Folder penyimpanan foto
    $target_dir = __DIR__ . "/img/";

    if (!is_dir($target_dir)) {
        exit("Folder img tidak ditemukan.");
    }

    // Nama file foto 
    $ekstensi = $formatDiizinkan[$mime];
    $nama_foto = $nim . "_" . time() . "." . $ekstensi;
    $target_file = $target_dir . $nama_foto;

    if (!move_uploaded_file(
        $_FILES["foto"]["tmp_name"],
        $target_file
    )) {
        exit("Gagal menyimpan foto.");
    }
}

// Menyimpan data mahasiswa
$sql = "INSERT INTO nilaimhsw
        (nim, namalengkap, nilaiakhir, nilaihuruf, predikat, foto)
        VALUES (?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    if ($target_file !== null && file_exists($target_file)) {
        unlink($target_file);
    }

    exit("Gagal menyiapkan query: " . mysqli_error($conn));
}

mysqli_stmt_bind_param(
    $stmt,
    "ssdsss",
    $nim,
    $namalengkap,
    $nilaiakhir,
    $nilaihuruf,
    $predikat,
    $nama_foto
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: viewdata.php");
    exit;
}

$error = mysqli_stmt_error($stmt);

if ($target_file !== null && file_exists($target_file)) {
    unlink($target_file);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);

exit("Gagal menyimpan data: " . htmlspecialchars($error));
?>
