<!DOCTYPE HTML>
<html>

<head>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>

<body>

    <?php

    // koneksi database
    require_once __DIR__ . "/connection1.php";

    // inisialisasi
    $nimErr = $namaErr = $nilaiErr = "";
    $nim = $nama = $nilai = "";

    // Trigger Engine
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // VALIDASI NIM
        if (empty($_POST["nim"])) {
            $nimErr = "NIM wajib diisi!";
        } else {

            $nim = sanitasi($_POST["nim"]);

            if (!preg_match("/^[0-9]*$/", $nim)) {
                $nimErr = "NIM hanya boleh berupa angka!";
            } elseif (strlen($nim) != 10) {
                $nimErr = "NIM harus terdiri dari 10 angka!";
            }
        }


        // VALIDASI NAMA MAHASISWA
        if (empty($_POST["nama_mhsw"])) {
            $namaErr = "Nama Mahasiswa wajib diisi!";
        } else {

            $nama = sanitasi($_POST["nama_mhsw"]);

            if (!preg_match("/^[a-zA-Z-' ]*$/", $nama)) {
                $namaErr = "Hanya huruf dan spasi yang diperbolehkan!";
            }
        }


        // VALIDASI NILAI AKHIR
        if (empty($_POST["nilai_akhir"]) && $_POST["nilai_akhir"] !== "0") {
            $nilaiErr = "Nilai Akhir wajib diisi!";
        } else {

            $nilai = sanitasi($_POST["nilai_akhir"]);

            // Validasi Format
            if (!is_numeric($nilai)) {
                $nilaiErr = "Nilai harus berupa angka dan titik!";
            }
        }
    }


    function sanitasi(string $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }


    function konversi_nilai($nilai)
    {
        if ($nilai < 0 || $nilai > 100) {

            return [
                'huruf' => 'Tidak Valid',
                'predikat' => 'Masukkan Nilai yang Valid'
            ];
        } elseif ($nilai <= 34.50) {

            return [
                'huruf' => 'E',
                'predikat' => 'Tidak Lulus'
            ];
        } elseif ($nilai <= 50.50) {

            return [
                'huruf' => 'D',
                'predikat' => 'Kurang Memuaskan'
            ];
        } elseif ($nilai <= 60.50) {

            return [
                'huruf' => 'C',
                'predikat' => 'Cukup Memuaskan'
            ];
        } elseif ($nilai <= 80.50) {

            return [
                'huruf' => 'B',
                'predikat' => 'Memuaskan'
            ];
        } else {

            return [
                'huruf' => 'A',
                'predikat' => 'Sangat Memuaskan'
            ];
        }
    }

    ?>

    <h2>Form Data Mahasiswa</h2>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

        NIM: <span class="error">*</span><br>
        <input type="text" name="nim" value="<?php echo $nim; ?>">
        <span class="error">
            <?php echo $nimErr; ?>
        </span>

        <br><br>


        Nama Mahasiswa: <span class="error">*</span><br>
        <input type="text" name="nama_mhsw" value="<?php echo $nama; ?>">
        <span class="error">
            <?php echo $namaErr; ?>
        </span>

        <br><br>


        Nilai Akhir: <span class="error">*</span><br>
        <input type="text" name="nilai_akhir" value="<?php echo $nilai; ?>">
        <span class="error">
            <?php echo $nilaiErr; ?>
        </span>

        <br><br>


        <span class="error">* required field</span>

        <br><br>

        <input type="submit" name="submit" value="Simpan">

    </form>


    <?php

    // Output Akhir
    echo "<h2>Your Input:</h2>";

    if (
        $_SERVER["REQUEST_METHOD"] == "POST"
        && empty($nimErr)
        && empty($namaErr)
        && empty($nilaiErr)
    ) {

        $hasil = konversi_nilai($nilai);


        if ($hasil['huruf'] == 'Tidak Valid') {

            echo "Ulangi Input Nilai Akhir dengan Benar <br>";
        } else {

            $nim_mhsw = $nim;
            $nama_mhsw = $nama;
            $nilai_akhir = $nilai;
            $nilai_huruf = $hasil['huruf'];
            $predikat = $hasil['predikat'];


            // ==========================
            // INSERT KE DATABASE
            // ==========================

            $sql = "INSERT INTO nilaimhsw
                    (nim, namalengkap, nilaiakhir, nilaihuruf, predikat)
                    VALUES
                    ('$nim_mhsw', '$nama_mhsw', '$nilai_akhir', '$nilai_huruf', '$predikat')";


            if (mysqli_query($conn, $sql)) {

                echo "Data berhasil disimpan ke database.<br><br>";
            } else {

                echo "Error: " . mysqli_error($conn);
            }


            // Jika Tidak Lulus, tampilkan warna merah
            if ($predikat == 'Tidak Lulus') {
                $predikat = '<span class="error">' . $predikat . '</span>';
            }


            // ==========================
            // TAMPILKAN HASIL
            // ==========================

            echo '<table border="1" style="border-collapse: collapse;" cellpadding="5">';

            echo '<tr>';
            echo '<th>NIM</th>';
            echo '<th>Nama Mahasiswa</th>';
            echo '<th>Nilai Akhir</th>';
            echo '<th>Nilai Huruf</th>';
            echo '<th>Predikat</th>';
            echo '</tr>';

            echo '<tr>';
            echo '<td>' . $nim_mhsw . '</td>';
            echo '<td>' . $nama_mhsw . '</td>';
            echo '<td>' . $nilai_akhir . '</td>';
            echo '<td>' . $nilai_huruf . '</td>';
            echo '<td>' . $predikat . '</td>';
            echo '</tr>';

            echo '</table>';
        }
    }

    ?>

</body>

</html>