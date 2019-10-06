<?php

namespace App\Rules;

use App\Classes\Cts;
use Illuminate\Contracts\Validation\Rule;

class MatrixValidationRules implements Rule
{

    protected $message = '';
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {

        $mat = json_decode($value);

        //check if matrix could be converted to array
        if (!is_array($mat)) {
            $this->message = 'Matrix could not be created';
            return false;
        }

        //check if matrix could be converted to array
        if (sizeof($mat) == 0) {
            $this->message = 'Matrix is empty';
            return false;
        }

        //get number of columns of matrix
        if (is_array($mat[0])) {
            $no_cols_mat = sizeof($mat[0]);
        } else {
            $no_cols_mat = 1;
        }

        //get number of rows of matrix
        $no_rows_mat = sizeof($mat);

        //check first row should not be empty
        if ($no_cols_mat == 0) {
            $this->message = 'Matrix first row is empty';
            return false;
        }

        //check matrix is smaller than max allowed size
        if ($no_rows_mat > CTS::MATRIX_SIZE_MAX || $no_cols_mat > CTS::MATRIX_SIZE_MAX) {
            $this->message = 'Matrix is too big';
            return false;
        }

        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->message;
    }
}
