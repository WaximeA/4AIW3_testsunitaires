<?php

include('Calculatrice.php');

$notes = [
    '12',
    '13',
    '6',
    '10'
];

$calculatrice = new Calculatrice();

$avg = $calculatrice->avg($notes);
var_dump($avg);