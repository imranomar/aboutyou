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
        $this->withHeader('HTTP_ACCEPT','application/json');
    }

    public function testWithOutCredentials()
    {
        $this->post(route('mul'))->assertStatus(Cts::HTTP_STATUS_UNAUTHORIZED);
    }

    public function testWithValidCredentials()
    {
        $this->withHeader('Authorization','Basic aW1yYW5vbWFyQGdtYWlsLmNvbTpxd2Vxd2UxMjM=');
        $user = new User;
        $user->name = "imran";
        $user->email = "imranomar@gmail.com";
        $user->password = Hash::make('qweqwe123');
        $user->save();
        $data_sent = [
            'mat1' => "[[1,2],[3,4]]",
            'mat2' => "[[1,2],[3,4]]",
        ];
        $result =array(array('A'=>7,'B'=>10),array('A'=>15,'B'=>22));
        $expected = array('error'=>'', 'cached'=>'false', 'result'=>$result);
        $this->post(route('mul'), $data_sent)->assertStatus(Cts::HTTP_STATUS_OK)->assertJson($expected);

    }
    public function testWithInValidCredentials()
    {
        $this->withHeader('Authorization','Basic XXXXXXXvbWFyQGdtYWlsLmNvbTpxd2Vxd2UxMjM=');
        $user = new User;
        $user->name = "imran";
        $user->email = "imranomar@gmail.com";
        $user->password = Hash::make('qweqwe123');
        $user->save();
        $this->post(route('mul'))->assertStatus(Cts::HTTP_STATUS_UNAUTHORIZED);
    }



}
