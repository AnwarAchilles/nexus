<?php

// Simpan waktu awal eksekusi
$start_time = microtime(true);

/**
 * Menghitung waktu eksekusi dalam milidetik
 *
 * @param float $start_time Waktu mulai
 * @return string Waktu eksekusi dalam milidetik
 */
function speedResult($start_time) {
    $end_time = microtime(true);
    return number_format(($end_time - $start_time) * 1000, 4);
}

/**
 * Menghasilkan string titik yang panjangnya bertambah
 *
 * @param int $rows Jumlah iterasi
 * @return string Hasil string titik
 */
function loopProcess($rows) {
    $x = "";
    for ($i = 1; $i <= $rows; $i++) {
        $x .= str_repeat(".", $i);
    }
    return $x;
}