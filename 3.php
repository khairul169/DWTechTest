<?php

function drawImage($num) {
    if ($num % 2 == 0)
        return;
    
    $half = ($num / 2.0);

    for ($y = -floor($half); $y < ceil($half); $y++) {
        for ($x = -floor($half); $x < ceil($half); $x++) {
            // Print '@' jika nilai absolut dari x kurang dari nilai absolut dari y
            if (abs($x) <= abs($y))
                echo "@";
            else
                echo "=";
            
            // Print whitespace
            echo " ";
        }

        echo "\n";
    }
}

echo "drawImage(5):\n";
drawImage(5);

echo "\n";
echo "drawImage(7):\n";
drawImage(7);

?>
