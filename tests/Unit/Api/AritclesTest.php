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

        $token = $this->getToken();

        $rs = $this->json('get', '/api/articles', [], ['HTTP_Authorization' => 'Bearer ' . $token]);
        $rs->assertSeeText('per_page');
        $rs->assertSeeText('data');
        $rs->assertStatus(200);
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
