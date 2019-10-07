<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MatrixDBCacheModel extends Model
{
    protected $fillable = ['mat1','result','mat2','mat1hashed100chars','mat2hashed100chars'];
    protected $table = 'matrix_db_cache';
}
