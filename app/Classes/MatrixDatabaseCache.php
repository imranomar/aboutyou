<?php


namespace App\Classes;
use App\Interfaces\iCache;
use App\MatrixDBCacheModel;
use Illuminate\Support\Facades\Hash;

class MatrixDatabaseCache implements iCache
{

    //$mat1 array
    //$mat2 array
    //return array
    public static function read($mat1, $mat2)
    {
        $result = array();

        $json_mat1 = json_encode($mat1);
        $json_mat2 =  json_encode($mat2);

        $found = MatrixDBCacheModel::where('mat1first100chars','=',substr($json_mat1,0,100))
            ->where('mat2first100chars','=',substr($json_mat2,0,100))->get();
        foreach($found as $matrix)
        {
            if($matrix->mat1 == $json_mat1 && $matrix->mat2 == $json_mat2 )
            {
                $result = json_decode($matrix->result);
            }
        }
        return $result;
    }

    //$mat1 array
    //$mat2 array
    //$result array
    public static function write( $mat1, $mat2, $result)
    {
        $cache = new MatrixDBCacheModel;
        $json_mat1 = json_encode($mat1);
        $json_mat2 =  json_encode($mat2);
        $cache->mat1 = $json_mat1;
        $cache->mat2 = $json_mat2;
        $cache->mat1first100chars = substr($json_mat1,0,100);
        $cache->mat2first100chars = substr($json_mat2,0,100);
        $cache->result = json_encode($result);
        $cache->save();
    }
}
