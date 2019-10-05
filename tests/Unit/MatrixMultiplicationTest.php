<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Cts;

class MatrixMultiplicationTest extends TestCase
{


    use RefreshDatabase; //migrate new database ( in memory sqlite in phpunit conf file )

    public function setUp(): void
    {
        parent::setUp();
        $this->withHeader('HTTP_ACCEPT','application/json');
    }

    //2*2 - 2*2
    public function test1()
    {
        $data_sent = [
            'mat1' => "[[1,2],[3,4]]",
            'mat2' => "[[1,2],[3,4]]",
        ];
        $expected = array(array(7,10),array(15,22));
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*3 - 3*3
    public function test2()
    {
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2,3],[4,5,6],[7,8,9]]",
        ];
        $expected = array(array(30,36,42),array(66,81,96),array(102,126,150));
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*3 - 2*3
    public function test3()
    {
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2,3],[4,5,6]]",
        ];
        $expected = array('error'=>'Matrix cannot be multiplied');
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

//        BELOW GIVES ERROR 500
//    public function test1()
//    {
//        $data_sent = [
//            'num1' => "2",
//            'num2' => "3",
//        ];
//
//        $data_received = "[[7,10],[15,22]]";
//
//        $result = $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->content();
//        $this->assertTrue($result==$data_received);
//
//    }
}
