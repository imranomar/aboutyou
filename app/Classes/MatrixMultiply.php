<?php


namespace App;
use http\Exception;

class MatrixMultiply
{
    public static function multiply($mat1 , $mat2)
    {

        $res = array(); //array to store the result

        //Get columns of matrix 1
        if (is_array($mat1[0])) {
            $no_cols_mat1 = sizeof($mat1[0]);
        } else {//support [3]*[5] also instead of [[3]]*[[5]] only
            $mat1[0] = array($mat1[0]);
            $no_cols_mat1 = 1;
        }

        //Get columns of matrix 2
        if (is_array($mat2[0])) {
            $no_cols_mat2 = sizeof($mat2[0]);
        } else { //support [3]*[5] also instead of [[3]]*[[5]] only
            $mat2[0] = array($mat2[0]);
            $no_cols_mat2 = 1;
        }

        //Get number of rows of both matrix
        $no_rows_mat1 = sizeof($mat1);
        $no_rows_mat2 = sizeof($mat2);

        //Throw error if matrices are not compatible for multiplication
        if ($no_cols_mat1 != $no_rows_mat2) {
            throw new \Exception('Matrices cannot be multiplied',Cts::HTTP_UNPROCESSABLE_ENTITY);
        }

        //Loop through all rows of mat1
        for ($i = 0; $i <= sizeof($mat1) - 1; $i++) {
            if (sizeof($mat1[$i]) != $no_cols_mat1) {
                throw new \Exception('Matrix 1 - uneven row lengths',Cts::HTTP_UNPROCESSABLE_ENTITY);
            }

            $row_of_mat1 = $mat1[$i];
            //Repeat for number of cols in mat2
            for ($j = 0; $j <= $no_cols_mat2 - 1; $j++) {
                //Check of the no of col of row of mat2 is right and do it only once
                if ($i == 0) {
                    if (sizeof($mat2[$j]) != $no_cols_mat2) {
                        throw new \Exception('Matrix 2 - uneven row lengths',Cts::HTTP_UNPROCESSABLE_ENTITY);
                    }
                }

                $sum = 0;
                //Loop through values of a row of mat1
                for ($k = 0; $k <= sizeof($row_of_mat1) - 1; $k++) {

//                  echo $mat1[$i][$k] . " " . $mat2[$k][$j] . "<BR>";

                    if (!is_numeric($mat1[$i][$k])) {
                        throw new \Exception('Non numerical entity encountered in Matrix 1',Cts::HTTP_UNPROCESSABLE_ENTITY);
                    }

                    if (!is_numeric($mat2[$k][$j])) {
                        throw new \Exception('Non numerical entity encountered in Matrix 2',Cts::HTTP_UNPROCESSABLE_ENTITY);
                    }

                    $sum += ($mat1[$i][$k] * $mat2[$k][$j]);
                }
//              echo "sum:". $sum."<BR>";
                $res[$i][Helper::intToLetters($j)] = $sum; //i is taken as it mat1 will have same number of rows as the result
            }
        }

        return $res;
    }
}