<?php


namespace App\Classes;
use App\Interfaces\iCache;
use App\MatrixDBCache;

class MatrixDatabaseCache implements iCache
{

    public static function read(String $mat1,String $mat2)
    {
        $mat1_serial = serialize($mat1);
        $mat2_serial = serialize($mat2);
        return MatrixDBCache::where('mat1','=',$mat1_serial)->where('mat2','=',$mat2_serial)->first();
    }

    public static function write(String $mat1,String $mat2,String $result)
    {
        $cache = new MatrixDBCache;
        $cache->mat1 = serialize($mat1);
        $cache->mat1 = serialize($mat2);
        $cache->result = serialize($result);
        $cache->save();
    }
}
