<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Classes\Cts;

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
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4]]",
            'mat2' => "[[1,2],[3,4]]",
        ];
        $result =array(array('A'=>7,'B'=>10),array('A'=>15,'B'=>22));
        $expected = array('error'=>'', 'cached'=>'false', 'result'=>$result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*3 - 3*3
    public function test2()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2,3],[4,5,6],[7,8,9]]",
        ];
        $result = array(array('A'=>30,'B'=>36,'C'=>42),array('A'=>66,'B'=>81,'C'=>96),array('A'=>102,'B'=>126,'C'=>150));
        $expected = array('error'=>'', 'cached'=>'false', 'result'=>$result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //2*3 - 2*3 - cannot be multiplied
    public function test3()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2,3],[4,5,6]]",
        ];
        $expected = array('error'=>'Matrices cannot be multiplied');
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

    //2*3 - 3*2
    public function test4()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2],[3,4],[5,6]]",
        ];
        $result = array(array('A'=>22,'B'=>28),array('A'=>49,'B'=>64));
        $expected = array('error'=>'', 'cached'=>'false', 'result'=>$result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*2 - 2*3
    public function test5()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4],[5,6]]",
            'mat2' => "[[1,2,3],[4,5,6]]",
        ];
        $result = array(array('A'=>9,'B'=>12,'C'=>15),array('A'=>19,'B'=>26,'C'=>33),array('A'=>29,'B'=>40,'C'=>51));
        $expected = array('error'=>'', 'cached'=>'false', 'result'=>$result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*3 - 2*3 - cannot be multiplied
    public function test23()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2,3],[4,5,6]]",
        ];
        $expected = array('error'=>'Matrices cannot be multiplied');
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

}
