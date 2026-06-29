<?php

if (!function_exists('bn_number')) {
    function bn_number($number)
    {
        if (app()->getLocale() !== 'bn') {
            return (string) $number;
        }

        $english = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $bengali = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
        return str_replace($english, $bengali, (string) $number);
    }
}
