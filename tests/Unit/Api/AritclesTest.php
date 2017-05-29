<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Http\Request;
class AritclesTest extends TestCase
{


    public function testIndex(){

        $user = \Auth::loginUsingId(2);
//        $user = User::where('id', 2)->first();
        $token = $this->getToken();

        die($token);

        $response = $this->actingAs($user)->call('get', 'api/articles', [], [], [],
            ['HTTP_Authorization' => 'Bearer ' . $token]);

        die($response->getContent());
    }

    protected function getToken(){
        try{
            $createToken = $this->call('get', '/getToken?key=base64:KADKAYGMWu1AMyOruYr/yycQFb6pJtFVVYGAXLe0Dfw=');
            $user = $createToken->getContent();
            $user = json_decode($user);
            return $user->token;
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            return null;
        }
    }
}
