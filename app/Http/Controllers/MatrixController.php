<?php

namespace App\Http\Controllers;

use App\Cts;
use App\Helper;
use App\MatrixLog;
use App\MatrixMultiply;
use Illuminate\Http\Request;
use App\Http\Requests\MartixValidationRequest;

class MatrixController extends Controller
{

    public function multiply(MartixValidationRequest $r)
    {
        try
        {
            return json_encode(MatrixMultiply::multiply(json_decode($r->mat1),json_decode($r->mat2)));
        }
        catch(\Exception $e)
        {

        }

    }


}
