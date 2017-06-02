<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Http\Request;
use Tests\Unit\BaseUnit;
class AritclesTest extends BaseUnit
{

    public function testIndex(){
        $url = route('articles.index');
        $token = $this->getToken();

        $jsonReponse = $this->json('get', $url, [], ['HTTP_Authorization' => 'Bearer ' . $token]);
        $jsonReponse->assertStatus(200);
        $jsonReponse->assertSeeText('"status":1');
        $jsonReponse->assertSeeText('"per_page"');
    }

    public function testStore(){

        $data = [
            'title' => 'jack test',
            'contents' => 'text content'
        ];
        $url = route('articles.store');
        $response = $this->json('post', $url, $data, ['HTTP_Authorization' => 'Bearer ' . $this->getToken()]);
        $response->assertStatus(200);
        $response->assertSeeText('"status":1', json_encode(json_decode($response->getContent())) );
        return;
    }

    public function testDelete(){

    }

    public function testShow(){
        $url = route('articles.show',[3]);
        $response = $this->json('get', $url, [], ['HTTP_Authorization' => 'Bearer ' . $this->getToken()]);
        $response->assertStatus(200);
        $response->assertSeeText('"status":1');
        $response->assertSeeText('"data":');
    }

}
