<?php

$input = [3,4,5,6,7,8];
echo "Input : " . json_encode($input) . "\n\n";

// Vars
$min = 0;
$max = 0;

// Iterasi tiap angka
for ($i=0; $i < count($input); $i++) {
    echo "Angka " . ($i + 1) . " : ";

    $start = true;
    $sum = 0;

    for ($j=0; $j < count($input); $j++) {
        if ($i == $j)
            continue;
        
        // Ambil angka dari array
        $angka = $input[$j];
        
        // Print array
        echo (!$start ? "+" : '') . $angka;

        // Tambahkan jumlah angka sekarang
        $sum += $angka;
        $start = false;
    }

    // Print jumlah angka
    echo " = $sum\n";

    // Set angka terkecil dan terbesar
    if ($min == 0 || $sum < $min)
        $min = $sum;
    
    if ($max == 0 || $sum > $max)
        $max = $sum;
}

echo "\nMaka Angka Terkecil dan terbesar adalah $min dan $max";

?>
