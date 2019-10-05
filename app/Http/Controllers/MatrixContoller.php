<?php

namespace App\Http\Controllers;

use App\Cts;
use Illuminate\Http\Request;

class MatrixContoller extends Controller
{

    public function multiply(Request $r)
    {
        //[[[1,2],[3,4]],[[1,2],[3,4]]]
        //    echo "<pre>";

        $res = array(); //array to store the result

        $mat1= json_decode($r->mat1);

        if(json_last_error()!==JSON_ERROR_NONE)
        {
            return response( json_encode(array('error'=>'Invalid Json for Matrix 1')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        $mat2= json_decode($r->mat2);

        if(json_last_error()!==JSON_ERROR_NONE)
        {
            return response( json_encode(array('error'=>'Invalid Json for Matrix 2')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(!is_array($mat1))
        {
            return response( json_encode(array('error'=>'Matrix 1 could not be created')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(!is_array($mat2))
        {
            return response( json_encode(array('error'=>'Matrix 2 could not be created')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(sizeof($mat1)==0)
        {
            return response( json_encode(array('error'=>'Matrix 1 is empty')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        if(sizeof($mat2)==0)
        {
            return response( json_encode(array('error'=>'Matrix 2 is empty')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }


        $no_cols_mat1 = sizeof($mat1[0]);
        $no_cols_mat2 = sizeof($mat2[0]);
        $no_rows_mat2 = sizeof($mat2);

        if($no_cols_mat1==0)
        {
            return response( json_encode(array('error'=>'Matrix 1 first row is empty')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        if($no_cols_mat2==0)
        {
            return response( json_encode(array('error'=>'Matrix 2 second row is empty')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        if($no_cols_mat1!=$no_rows_mat2)
        {
            return response( json_encode(array('error'=>'Matrices cannot be multiplied')), Cts::HTTP_UNPROCESSABLE_ENTITY);
        }


        //loop through all rows of mat1
        for($i=0;$i<=sizeof($mat1)-1;$i++)
        {
            if(sizeof($mat1[$i])!=$no_cols_mat1)
            {
                return response( json_encode(array('error'=>'Matrix 1 - uneven row lengths')), Cts::HTTP_UNPROCESSABLE_ENTITY);
            }

            $row_of_mat1 = $mat1[$i];
            //repeat for number of cols in mat2
            for($j=0;$j<=$no_cols_mat2-1;$j++)
            {
                //check of the no of col of row of mat2 is right and do it only once
                if($i==0)
                {
                    if(sizeof($mat2[$j])!=$no_cols_mat2)
                    {
                        return response( json_encode(array('error'=>'Matrix 2 - uneven row lengths')), Cts::HTTP_UNPROCESSABLE_ENTITY);
                    }
                }

                $sum = 0;
                //loop through values of a row of mat1
                for($k=0;$k<=sizeof($row_of_mat1)-1;$k++)
                {

//                  echo $mat1[$i][$k] . " " . $mat2[$k][$j] . "<BR>";

                    if(!is_numeric($mat1[$i][$k]))
                    {
                        return response( json_encode(array('error'=>'Non numerical entity encourtered in Matrix 1:')), Cts::HTTP_UNPROCESSABLE_ENTITY);
                    }

                    if( !is_numeric($mat2[$k][$j]))
                    {
                        return response( json_encode(array('error'=>'Non numerical entity encourtered in Matrix 2')), Cts::HTTP_UNPROCESSABLE_ENTITY);
                    }

                    $sum += ($mat1[$i][$k] * $mat2[$k][$j]);
                }
//              echo "sum:". $sum."<BR>";
                $res[$i][] = $sum; //i is taken as it mat1 will have same number of rows as the result
            }
        }

        return json_encode($res);
//    echo "</pre>";
    }

    //int to alphabets
    function intToLetters(Request $r)
    {
        $no = $r->no;
        $alphas = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $count = sizeof($alphas);
        $repeat = (int)($no / $count);
        $mod = $no % $count;
        $string = str_repeat("A",$repeat) . $alphas[$mod];
        return array($string);
    }



}
