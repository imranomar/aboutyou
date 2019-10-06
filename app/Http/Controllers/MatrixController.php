<?php

namespace App\Http\Controllers;

use App\Cts;
use App\Helper;
use App\MatrixLog;
use Illuminate\Http\Request;
use App\Http\Requests\MartixValidationRequest;

class MatrixController extends Controller
{

    public function multiply(MartixValidationRequest $r)
    {
        //[[[1,2],[3,4]],[[1,2],[3,4]]]
        //    echo "<pre>";
        $enable_caching = false;

        $res = array(); //array to store the result

        $mat1 = json_decode($r->mat1);
        $mat2 = json_decode($r->mat2);

        //get columns of matrix 1
        if (is_array($mat1[0])) {
            $no_cols_mat1 = sizeof($mat1[0]);
        } else {//support [3]*[5] also instead of [[3]]*[[5]] only
            $mat1[0] = array($mat1[0]);
            $no_cols_mat1 = 1;
        }

        //get columns of matrix 2
        if (is_array($mat2[0])) {
            $no_cols_mat2 = sizeof($mat2[0]);
        } else { //support [3]*[5] also instead of [[3]]*[[5]] only

            $mat2[0] = array($mat2[0]);
            $no_cols_mat2 = 1;
        }

        //get number of rows of both matrix
        $no_rows_mat1 = sizeof($mat1);
        $no_rows_mat2 = sizeof($mat2);


        //throw error if matrices are not compatible for multiplication
        if ($no_cols_mat1 != $no_rows_mat2) {
            return response(json_encode(array('error' => 'Matrices cannot be multiplied')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        //check if matrix mul already cached
        $mat1_serial = serialize($mat1); //used later
        $mat2_serial = serialize($mat2);  //used later
        $cached = MatrixLog::where('mat1', '=', $mat1_serial)->where('mat2', '=', $mat2_serial)->first();


        if (!$cached || !$enable_caching) {
            //loop through all rows of mat1
            for ($i = 0; $i <= sizeof($mat1) - 1; $i++) {
                if (sizeof($mat1[$i]) != $no_cols_mat1) {
                    return response(json_encode(array('error' => 'Matrix 1 - uneven row lengths')), Cts::HTTP_UNPROCESSABLE_ENTITY);
                }

                $row_of_mat1 = $mat1[$i];
                //repeat for number of cols in mat2
                for ($j = 0; $j <= $no_cols_mat2 - 1; $j++) {
                    //check of the no of col of row of mat2 is right and do it only once
                    if ($i == 0) {
                        if (sizeof($mat2[$j]) != $no_cols_mat2) {
                            return response(json_encode(array('error' => 'Matrix 2 - uneven row lengths')), Cts::HTTP_UNPROCESSABLE_ENTITY);
                        }
                    }

                    $sum = 0;
                    //loop through values of a row of mat1
                    for ($k = 0; $k <= sizeof($row_of_mat1) - 1; $k++) {

//                  echo $mat1[$i][$k] . " " . $mat2[$k][$j] . "<BR>";

                        if (!is_numeric($mat1[$i][$k])) {
                            return response(json_encode(array('error' => 'Non numerical entity encourtered in Matrix 1:')), Cts::HTTP_UNPROCESSABLE_ENTITY);
                        }

                        if (!is_numeric($mat2[$k][$j])) {
                            return response(json_encode(array('error' => 'Non numerical entity encourtered in Matrix 2')), Cts::HTTP_UNPROCESSABLE_ENTITY);
                        }

                        $sum += ($mat1[$i][$k] * $mat2[$k][$j]);
                    }
//              echo "sum:". $sum."<BR>";
                    $res[$i][Helper::intToLetters($j)] = $sum; //i is taken as it mat1 will have same number of rows as the result
                }


            }

            //cache results
            $log = new MatrixLog;
            $log->mat1 = $mat1_serial;
            $log->mat2 = $mat2_serial;
            $log->result = serialize($res);
            $log->save();
        }
        else { //found in cache
            $res = unserialize($cached->result);
        }

        return json_encode($res);
//    echo "</pre>";
    }


}
