<?php

namespace Tests\Unit;

use App\Classes\Cts;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class MiddlewareTest extends TestCase
{
    use RefreshDatabase; //migrate new database ( in memory sqlite in phpunit conf file )

    public function setUp(): void
    {
        parent::setUp();
        $this->withHeader('HTTP_ACCEPT', 'application/json');
    }

    public function testWithOutCredentials()
    {
        $this->post(route('mul'))->assertStatus(Cts::HTTP_STATUS_UNAUTHORIZED);
    }


}
