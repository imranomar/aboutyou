<?php

namespace Tests\Unit;

use App\Cts;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Helper;
class IntToLettersTest extends TestCase
{

    public function test1()
    {
        $num = 0;
        $expect = 'A';
        $actual = Helper::intToLetters($num);
        $this->assertEquals($expect,$actual);
    }
}
