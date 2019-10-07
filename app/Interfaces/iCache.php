<?php


namespace App\Interfaces;


interface iCache
{
    public static function read( $mat1, $mat2);
    public static function write( $mat1,$mat2, $result);
}
