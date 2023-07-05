<?php

// Ilosc monet
$coins = [
    '5 zł' => 1,
    '2 zł' => 3,
    '1 zł' => 5,
    '50 gr' => 10,
    '20 gr' => 20,
    '10 gr' => 200,
    '5 gr' => 100,
    '2 gr' => 100,
    '1 gr' => 10000
];

// Funkcja do wydawania reszty
function wydajReszte($reszta)
{
    global $coins;
    $wydaneMonety = [];

    $resztaGr = round($reszta * 100, 2); // Zmieniamy walute na groszę

    $monety = [
        '5 zł' => 500,
        '2 zł' => 200,
        '1 zł' => 100,
        '50 gr' => 50,
        '20 gr' => 20,
        '10 gr' => 10,
        '5 gr' => 5,
        '2 gr' => 2,
        '1 gr' => 1
    ];

    foreach ($monety as $moneta => $wartosc) {
        if ($wartosc <= $resztaGr) {
            $ileWydac = floor($resztaGr / $wartosc);
            $ileWydac = min($ileWydac, $coins[$moneta]); // Sprawdzamy jakie są dostępne monety

            if ($ileWydac > 0) {
                $wydaneMonety[$moneta] = $ileWydac;
                $resztaGr -= $ileWydac * $wartosc;
                $coins[$moneta] -= $ileWydac;
            }
        }
    }

    if ($resztaGr > 0) {
        echo "Nie można wydać pełnej reszty.\n";
    } else {
        foreach ($wydaneMonety as $moneta => $ilosc) {
            echo "Wydaj $ilosc monet $moneta\n";
        }
    }

    echo "\n";
}

// Pobierz reszty jako argumenty z wiersza poleceń
$reszty = array_slice($argv, 1);

// Wydawanie reszty
foreach ($reszty as $reszta) {
    echo "Dla reszty $reszta zł:\n";
    wydajReszte(floatval(str_replace(',', '.', $reszta))); // zamiana przecinków na kropki
}
?>
