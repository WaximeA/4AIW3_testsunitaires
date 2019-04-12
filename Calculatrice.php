<?php

declare(strict_types=1);

class Calculatrice
{
    public function add(int $number1, int $number2): int
    {
        return $number1 + $number2;
    }

    public function sub(int $number1, int $number2): int
    {
        return $number1 - $number2;
    }

    public function mul(int $number1, int $number2): int
    {
        return $number1 * $number2;
    }

    public function div(int $number1, int $number2): int
    {
        if ($number2 == 0){
            throw new Exception('Division par zero');
        }

        return $number1 / $number2;
    }

    public function avg(array $tab): float
    {
        if (count($tab)) {
            throw new Exception('Tableau vide');
        }
        return array_sum($tab) / count($tab);
    }
}