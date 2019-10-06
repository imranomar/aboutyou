<?php


namespace App\Interfaces;


interface iCache
{
    public static function read(String $mat1,String $mat2): String;
    public static function write(String $mat1,String $mat2,String $result);
}
