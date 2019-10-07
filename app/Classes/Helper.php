<?php


namespace App\Classes;


use Illuminate\Http\Request;

class Helper
{
    //int to alphabets
    public static function intToLetters(int $no): String
    {
        $alphas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $count = sizeof($alphas);
        $repeat = (int)($no / $count);
        $mod = $no % $count;
        $string = str_repeat("A",$repeat) . $alphas[$mod];
        return $string;
    }

}
