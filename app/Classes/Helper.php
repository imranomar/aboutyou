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

    public static function isValidHttpStatusCode(String $status_code): bool
    {
        $arr_status_code = array("100","101","102","200","201","203","204","202","205","206","207","208","226","300",
            "301","302","303","304","305","306","307","308","400","401","402","403","404","405","406","407","408",
            "409","410","411","412","413","414","415","416","417","418","419","420","420","422","423","424","424",
            "425","426","428","429","431","444","449","450","451","451","494","495","496","497","499","500","501",
            "502","503","504","505","506","507","508","509","510","511","598","599");

        if(in_array($status_code, $arr_status_code)){
            return true;
        }else{
            return false;
        }
    }

}
