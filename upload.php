<?php
// $namafile = $_FILES['photo']['name'];
// $tipefile = $_FILES['photo']['type'];
// $ukuranfile = $_FILES['photo']['size'];
// $temporaryfile = $_FILES['photo']['tmp_name'];
// $errfile = $_FILES['photo']['error'];

// echo "Nama file: " . $namafile . "<br>";
// echo "Tipe data: " . $tipefile . "<br>";
// echo "ukuran file: " . $ukuranfile . "<br>";
// echo "Alamat Temporary: " . $temporaryfile . "<br>";
// echo "Status Error: " . $errfile . "<br>";

// menentukan direktori tujuan/target 
$target_dir = "img/";
// menyimpan alamat lengkap (path name) dari file yg diunggah 
$target_file = $target_dir . basename($_FILES["photo"]["name"]);
// echo "Isi target file: " . $target_file . "<br>";
// inisialisasi 
$uploadOk = 1;
// mengkonversi extension file menjadi huruf kecil 
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// echo $imageFileType . "<br>";
// Checkpoint 1 (Autentikasi)
if (isset($_POST["submit"])) {
    // memeriksa apakah file benar 'actual image' or fake image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}

// Chechpoint 2 (Duplikasi)
// Memeriksa apakah nama file yg diunggah sudah ada di direktori tujuan/target 
if (file_exists($target_file)) {
    echo "Sorry, file already exists. <br>";
    $uploadOk = 0;
}

// Checkpoint 3 (Ukuran file)
// Memeriksa ukuran file yg diunggah tidak melebihi batas yg diunggah 
// Check file size
if ($_FILES["photo"]["size"] > 5000000) {
    echo "Sorry, your file is too large. <br>";
    $uploadOk = 0;
}

// Checkpoint 4 ()
// Allow certain file formats
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}

// Memeriksa apakah $upload sudah true (1), jika 0 berarti ada error
echo "Status upload: " . $uploadOk . "<br>";

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // jika status oke, lanjut unggah file 
} else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
        // pindahkan fisik file dari temporary direktori ke target direktori     
        echo "The file " . htmlspecialchars(basename($_FILES["photo"]["name"])) . " has been uploaded.";

        // aksi paralel, catat ke tabel di database
        require_once __DIR__ . "/connection1.php";
        // query statement 
        $q = "INSERT INTO photo (file_name) VALUES ('$target_file')";

        // cek query berhasil atau tidak 
        if (mysqli_query($conn, $q)) {
            // berhasil -- pesan masuk 
            echo "<script>alert('New record created succesfully');</script>";
        } else {
            echo "Error: " . $q . "<br>" . mysqli_error($conn);
        }

        header('Location: readphoto.php');
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
