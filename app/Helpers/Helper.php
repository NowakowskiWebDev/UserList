<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

class Helper
{
    public static function division(int $value, int $number)
    {
        return $value / $number;
    }

    public static function multiplication(string $value, int $number)
    {
        return $value * $number;
    }
}
