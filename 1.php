<?php

$bagus = [
    'waktu' => strtotime('12:00'),
    'kecepatan' => 7,
    'jarak' => 0
];

$ismail = [
    'waktu' => strtotime('13:00'),
    'kecepatan' => 10,
    'jarak' => 0
];

// Waktu berjalan
$waktu = $bagus['waktu'];

while ($bagus['jarak'] == 0 || $bagus['jarak'] != $ismail['jarak']) {
    // Tambahkan jarak bagus
    $bagus['jarak'] += $bagus['kecepatan'];

    // Tambahkan jarak ismail apabila waktu menunjukkan pukul 13:00
    if ($waktu >= $ismail['waktu']) {
        $ismail['jarak'] += $ismail['kecepatan'];
    }

    // Tingkatkan waktu perdetik
    $waktu++;
}

// Waktu dimana jarak bagus dan ismail menyentuh angka yang sama
echo "Bagus dan Ismail berada pada titik yang sama pada pukul: \n";
echo strftime('%H:%M', $waktu);

?>
