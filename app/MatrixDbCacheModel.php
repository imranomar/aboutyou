<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MatrixDBCacheModel extends Model
{
    protected $fillable = ['mat1','result','mat2'];
    protected $table = 'matrixDbCache';
}
