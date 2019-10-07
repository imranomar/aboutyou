<?php

namespace App\Http\Controllers;

use App\Classes\MatrixDatabaseCache;
use App\Classes\Cts;
use App\Classes\Helper;
use App\Classes\MatrixMultiply;
use Illuminate\Http\Request;
use App\Http\Requests\MartixValidationRequest;

class MatrixController extends Controller
{

    public function multiply(MartixValidationRequest $r)
    {
        try
        {
            $mat1 = json_decode($r->mat1);
            $mat2 = json_decode($r->mat2);
            //search for matrices in db
            $cached = MatrixDatabaseCache::read($mat1, $mat2);
            if (!$cached) {
                //cache results
                $res = MatrixMultiply::multiply($mat1,$mat2);
                MatrixDatabaseCache::write($mat1, $mat2, $res);
                return  json_encode(array('error'=>'','cached'=>'false','result'=>$res));
            }
            else {
                return  json_encode(array('error'=>'','cached'=>'true','result'=>$cached));
            }
        }
        catch(\Exception $e) {
            return response(json_encode(array('error' => $e->getMessage())), $e->getCode());
        }

    }

    public function multiplyquick(MartixValidationRequest $r)
    {
        try
        {
            $mat1 = json_decode($r->mat1);
            $mat2 = json_decode($r->mat2);
            //search for matrices in db
            $cached = MatrixDatabaseCache::read($mat1, $mat2);
            if (!$cached) {
                //cache results
                $res = MatrixMultiply::multiplyquick($mat1,$mat2);
                MatrixDatabaseCache::write($mat1, $mat2, $res);
                return  json_encode(array('error'=>'','cached'=>'false','result'=>$res));
            }
            else {
                return  json_encode(array('error'=>'','cached'=>'true','result'=>$cached));
            }

        }
        catch(\Exception $e) {
            echo $e->getMessage();
            return response(json_encode(array('error' => $e->getMessage())), $e->getCode());
        }

    }


}
