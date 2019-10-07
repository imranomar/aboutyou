<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMatrixDbCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matrix_db_cache', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('mat1');
            $table->longText('mat2');
            $table->string('mat1first100chars')->index();
            $table->string('mat2first100chars')->index();
            $table->longText('result');
            $table->index(array('mat1first100chars','mat2first100chars'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matrix_logs');
    }
}
