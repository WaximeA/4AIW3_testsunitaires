<?php

class Calculatrice {
    public function add(int $number1, int $number2) :int {
        return $number1 + $number2;
    }

    public function sub(int $number1, int $number2) :int {
        return $number1 - $number2;
    }

    public function mul(int $number1, int $number2) :int {
        return $number1 * $number2;
    }

    public function div(int $number1, int $number2) :int {
        return $number1 / $number2;
    }

    public function avg(array $tab) :float {
        return array_sum($tab) / count($tab);
    }
}