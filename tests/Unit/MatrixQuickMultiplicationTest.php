<?php

namespace Tests\Unit;

use App\Classes\Cts;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MatrixQuickMultiplicationTest extends TestCase
{
    use RefreshDatabase; //migrate new database ( in memory sqlite in phpunit conf file )

    public function setUp(): void
    {
        parent::setUp();
        $this->withHeader('HTTP_ACCEPT', 'application/json');
    }

    //2*2 - 2*2
    public function test1()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4]]",
            'mat2' => "[[1,2],[3,4]]",
        ];
        $result = array(array('A' => 7, 'B' => 10), array('A' => 15, 'B' => 22));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*3 - 3*3
    public function test2()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2,3],[4,5,6],[7,8,9]]",
        ];
        $result = array(
            array('A' => 30, 'B' => 36, 'C' => 42),
            array('A' => 66, 'B' => 81, 'C' => 96),
            array('A' => 102, 'B' => 126, 'C' => 150)
        );
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //2*3 - 2*3 - cannot be multiplied
    public function test3()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2,3],[4,5,6]]",
        ];
        $expected = array('error' => 'Matrices cannot be multiplied');
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

    //2*3 - 3*2
    public function test4()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2],[3,4],[5,6]]",
        ];
        $result = array(array('A' => 22, 'B' => 28), array('A' => 49, 'B' => 64));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*2 - 2*3
    public function test5()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4],[5,6]]",
            'mat2' => "[[1,2,3],[4,5,6]]",
        ];
        $result = array(
            array('A' => 9, 'B' => 12, 'C' => 15),
            array('A' => 19, 'B' => 26, 'C' => 33),
            array('A' => 29, 'B' => 40, 'C' => 51)
        );
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*2 - 3*2
    public function test6()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4],[5,6]]",
            'mat2' => "[[1,2],[3,4],[5,6]]",
        ];
        $expected = array('error' => 'Matrices cannot be multiplied');
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

    //2*3 - 3*3
    public function test7()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2,3],[4,5,6],[7,8,9]]",
        ];
        $result = array(array('A' => 30, 'B' => 36, 'C' => 42), array('A' => 66, 'B' => 81, 'C' => 96));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //3*2 - 3*3 - cannot be multiplied
    public function test8()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[4,5],[7,8]]",
            'mat2' => "[[1,2,3],[4,5,6],[7,8,9]]",
        ];
        $expected = array('error' => 'Matrices cannot be multiplied');
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

    //3*2 - 2*2
    public function test9()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4],[5,6]]",
            'mat2' => "[[1,2],[3,4]]",
        ];
        $result = array(array('A' => 7, 'B' => 10), array('A' => 15, 'B' => 22), array('A' => 23, 'B' => 34));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }


    //2*3 - 2*2- cannot be multiplied
    public function test10()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2],[3,4]]",
        ];
        $expected = array('error' => 'Matrices cannot be multiplied');
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

    //3*3 - 2*3 - cannot be multiplied
    public function test11()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2,3],[4,5,6]]",
        ];
        $expected = array('error' => 'Matrices cannot be multiplied');
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

    //3*3 - 3*2 - cannot be multiplied
    public function test12()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2],[3,4],[5,6]]",
        ];
        $result = array(array('A' => 22, 'B' => 28), array('A' => 49, 'B' => 64), array('A' => 76, 'B' => 100));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //1*3 - 3*1 - cannot be multiplied
    public function test13()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3]]",
            'mat2' => "[[1],[2],[3]]",
        ];
        $result = array(array('A' => 14));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //2*3 - 2*2- incorrect json format
    public function test14()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3][4,5,6]]", //missing comma to test json
            'mat2' => "[[1,2],[3,4]]",
        ];
        $expected = array('Matrix is not in proper json format');
        $this->post(route('mulquick'),
            $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJsonFragment($expected);
    }

    //[1,2,3] - [[1],[2],[3]]- mat 1 is not in [[1,2,3]] format
    public function test15()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[1,2,3]", //missing comma to test json
            'mat2' => "[[1],[2],[3]]",
        ];

        $result = array(array('A' => 14));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mulquick'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }
}
