<?php

namespace Tests\Unit;

use App\Cts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Classes\Helper;

class HelperTest extends TestCase
{

    public function test1()
    {
        $num = 0;
        $expect = '0';
        $actual = Helper::intToLetters($num);
        $this->assertEquals($expect, $actual);
    }

    public function test2()
    {
        $num = 1;
        $expect = 'A';
        $actual = Helper::intToLetters($num);
        $this->assertEquals($expect, $actual);
    }


    public function test3()
    {
        $num = 25;
        $expect = 'Y';
        $actual = Helper::intToLetters($num);
        $this->assertEquals($expect, $actual);
    }

    public function test4()
    {
        $num = 26;
        $expect = 'Z';
        $actual = Helper::intToLetters($num);
        $this->assertEquals($expect, $actual);
    }

    public function test5()
    {
        $num = 27;
        $expect = 'AA';
        $actual = Helper::intToLetters($num);
        $this->assertEquals($expect, $actual);
    }




}
