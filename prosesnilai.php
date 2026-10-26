<?php

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
