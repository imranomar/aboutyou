<?php

namespace App\Http\Controllers;

use App\Classes\MatrixDatabaseCache;
use App\Classes\Cts;
use App\Classes\Helper;
use App\MatrixMultiply;
use Illuminate\Http\Request;
use App\Http\Requests\MartixValidationRequest;

class MatrixController extends Controller
{

    public function multiply(MartixValidationRequest $r)
    {
        try
        {
            $cached = MatrixDatabaseCache::read($r->mat1, $r->mat2);
            if (!$cached) {
                //cache results
                $res = MatrixMultiply::multiply(json_decode($r->mat1),json_decode($r->mat2));
                MatrixDatabaseCache::write($r->mat1, $r->mat2,$res);
                return $res;
            }
            else {
                return  json_encode(unserialize($cached->result));
            }

        }
        catch(\Exception $e) {
                return response(json_encode(array('error' => $e->getMessage())), $e->getCode());
        }

    }


}
