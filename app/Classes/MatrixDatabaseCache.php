<?php


namespace App\Classes;
use App\Interfaces\iCache;
use App\MatrixDBCacheModel;

class MatrixDatabaseCache implements iCache
{

    //$mat1 array
    //$mat2 array
    //return array
    public static function read($mat1, $mat2)
    {
        $result = array();

        $found = MatrixDBCacheModel::where('mat1','=',json_encode($mat1))->where('mat2','=',json_encode($mat2))->first();
        if($found)
        {
            $result =  json_decode($found->result);
        }
        return $result;
    }

    public static function write( $mat1, $mat2, $result)
    {
        $cache = new MatrixDBCacheModel;
        $cache->mat1 = json_encode($mat1);
        $cache->mat2 = json_encode($mat2);
        $cache->result = json_encode($result);
        $cache->save();
    }
}
