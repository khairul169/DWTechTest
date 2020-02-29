<?php

function drawImage($num) {
    if ($num % 2 == 0)
        return;
    
    $half = ($num / 2.0);

    for ($y = -floor($half); $y < ceil($half); $y++) {
        for ($x = -floor($half); $x < ceil($half); $x++) {
            // Print '@' jika nilai absolut x kurang dari atau sama dengan nilai absolut y
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

echo "drawImage(5);\nakan dicetak di layar:\n";
drawImage(5);

echo "\n";
echo "drawImage(7);\nakan dicetak di layar:\n";
drawImage(7);

?>
