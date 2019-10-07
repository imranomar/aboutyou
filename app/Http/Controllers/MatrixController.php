<?php

namespace App\Http\Controllers;

use App\Classes\MatrixDatabaseCache;
use App\Classes\Cts;
use App\Classes\Helper;
use App\Classes\MatrixMultiply;
use Illuminate\Http\Request;
use App\Http\Requests\MatrixValidationRequest;

class MatrixController extends Controller
{

    //multiply 2 matrices
    public function multiply(MatrixValidationRequest $r)
    {
        try {
            $mat1 = json_decode($r->mat1);
            $mat2 = json_decode($r->mat2);
            //search for matrices in db
            $cached = MatrixDatabaseCache::read($mat1, $mat2);
            if (!$cached) {
                //cache results
                $res = MatrixMultiply::multiply($mat1, $mat2);
                MatrixDatabaseCache::write($mat1, $mat2, $res);
                return json_encode(array('error' => '', 'cached' => 'false', 'result' => $res));
            } else {
                return json_encode(array('error' => '', 'cached' => 'true', 'result' => $cached));
            }
        } catch (\Exception $e) {
            $code = Helper::isValidHttpStatusCode($e->getCode()) ? $e->getCode() : 500;
            return response(json_encode(array('error' => $e->getMessage())), $code);
        }

    }

    //multiply 2 matrices quickly - 3 times faster
    public function multiplyQuick(MatrixValidationRequest $r)
    {
        try {
            $mat1 = json_decode($r->mat1);
            $mat2 = json_decode($r->mat2);
            //search for matrices in db
            $cached = MatrixDatabaseCache::read($mat1, $mat2);
            if ($cached) {
                //cache results
                $res = MatrixMultiply::multiplyquick($mat1, $mat2);
                MatrixDatabaseCache::write($mat1, $mat2, $res);
                return json_encode(array('error' => '', 'cached' => 'false', 'result' => $res));
            } else {
                return json_encode(array('error' => '', 'cached' => 'true', 'result' => $cached));
            }

        } catch (\Exception $e) {
            $code = Helper::isValidHttpStatusCode($e->getCode()) ? $e->getCode() : 500;
            return response(json_encode(array('error' => $e->getMessage())), $code);
        }

    }


}
