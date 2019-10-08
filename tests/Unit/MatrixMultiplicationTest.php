<?php

namespace Tests\Unit;

use App\Classes\Helper;
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
        $result = array(array(Helper::intToLetters(7), Helper::intToLetters(10)),
                        array(Helper::intToLetters(15), Helper::intToLetters(22)));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
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
        $result = array(
            array(Helper::intToLetters(30), Helper::intToLetters(36),Helper::intToLetters(42)),
            array(Helper::intToLetters(66), Helper::intToLetters(81), Helper::intToLetters(96)),
            array(Helper::intToLetters(102), Helper::intToLetters(126), Helper::intToLetters(150))
        );
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)
            ->assertJson($expected);
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
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson($expected);
    }

    //2*3 - 3*2
    public function test4()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2],[3,4],[5,6]]",
        ];
        $result = array(array(Helper::intToLetters(22), Helper::intToLetters(28)),
                        array(Helper::intToLetters(49), Helper::intToLetters(64)));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
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
        $result = array(
            array(Helper::intToLetters(9), Helper::intToLetters(12), Helper::intToLetters(15)),
            array(Helper::intToLetters(19), Helper::intToLetters(26), Helper::intToLetters(33)),
            array(Helper::intToLetters(29), Helper::intToLetters(40), Helper::intToLetters(51)));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
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
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson($expected);
    }

    //2*3 - 3*3
    public function test7()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6]]",
            'mat2' => "[[1,2,3],[4,5,6],[7,8,9]]",
        ];
        $result = array(array(Helper::intToLetters(30), Helper::intToLetters(36), Helper::intToLetters(42)),
                        array(Helper::intToLetters(66), Helper::intToLetters(81), Helper::intToLetters(96)));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
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
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)
            ->assertJson($expected);
    }

    //3*2 - 2*2
    public function test9()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4],[5,6]]",
            'mat2' => "[[1,2],[3,4]]",
        ];
        $result = array(array(Helper::intToLetters(7), Helper::intToLetters(10)),
                        array(Helper::intToLetters(15), Helper::intToLetters(22)),
                        array(Helper::intToLetters(23), Helper::intToLetters(34)));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
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
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
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
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }

    //3*3 - 3*2
    public function test12()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3],[4,5,6],[7,8,9]]",
            'mat2' => "[[1,2],[3,4],[5,6]]",
        ];
        $result = array(array(Helper::intToLetters(22), Helper::intToLetters(28)),
                        array(Helper::intToLetters(49), Helper::intToLetters(64)),
                        array(Helper::intToLetters(76), Helper::intToLetters(100)));

        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //1*3 - 3*1 - cannot be multiplied
    public function test13()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2,3]]",
            'mat2' => "[[1],[2],[3]]",
        ];
        $result = array(array(Helper::intToLetters(14)));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
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
        $this->post(route('mul'),
            $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJsonFragment($expected);
    }

    //[1,2,3] - [[1],[2],[3]]- mat 1 is not in [[1,2,3]] format
    public function test15()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[1,2,3]",
            'mat2' => "[[1],[2],[3]]",
        ];

        $result = array(array(Helper::intToLetters(14)));
        $expected = array('error' => '', 'cached' => 'false', 'result' => $result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);
    }

    //2*2 - 3*2
    public function test16()
    {
        $this->withoutMiddleware();
        $data_sent = [
            'mat1' => "[[1,2],[3,4]]", //missing comma to test json
            'mat2' => "[[1,2],[3,4],[5,6]]",
        ];

        $expected = array('error' => 'Matrices cannot be multiplied');
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_UNPROCESSABLE_ENTITY)->assertJson($expected);
    }
}
