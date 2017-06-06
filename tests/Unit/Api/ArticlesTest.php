<?php

namespace Tests\Unit\Api;

use App\Events\ArticleDestroyed;
use App\Jobs\TestJob;
use App\Models\Article;
use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use Illuminate\Http\Request;
use Tests\Unit\BaseUnit;
use App\Jobs\ProcessPodcast;
class ArticlesTest extends BaseUnit
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
        return $response->getContent();
    }

    public function testDestroy(){

        //$article = Article::find(28);
        //event(new ArticleDestroyed($article));
        $user = User::find(2);
        dispatch((new TestJob($user))->onConnection('redis')->delay(Carbon::now()->addSecond(30)));
        die(" \r \n end");

        //创建文章并获取id
        $newArticle = $this->testStore();
        $newArticle = json_decode($newArticle);
        $id = $newArticle->id;
        //删除文章
        $url = route('articles.destroy', $id);
        $response = $this->json('delete', $url, [], ['HTTP_Authorization' => 'Bearer ' . $this->getToken()]);
        $response->assertStatus(200);
        $response->assertSeeText('"status":1');
    }

    public function testShow(){
        $url = route('articles.show',[3]);
        $response = $this->json('get', $url, [], ['HTTP_Authorization' => 'Bearer ' . $this->getToken()]);
        $response->assertStatus(200);
        $response->assertSeeText('"status":1');
        $response->assertSeeText('"data":');
    }

}
