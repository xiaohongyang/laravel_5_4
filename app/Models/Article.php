<?php

namespace App\Models;

use App\Scopes\DeletedScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Scopes\AuthorScope;
use App\Observer\ArticleObserver;
use Illuminate\Support\Facades\Event;
use App\Events\ArticleReleased;

class Article extends Model
{
    //
    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

//        static::addGlobalScope(new AuthorScope);
//        static::addGlobalScope(new DeletedScope());

        Article::observe(ArticleObserver::class);

//        static::addGlobalScope('author', function (Builder $builder){
//            $builder->where('author', '=', '肖红阳');
//        });

    }


    use SoftDeletes;

    protected $primaryKey = 'id';

    public $incrementing = true;

    public $timestamps = true;

    public $fillable = ['title', 'author', 'user_id'];

    public function store(Request $request) {

        $article = new Article;
        $article->title = $request->title;
        $article->author = $request->get('author', '');
        return $article->save();
    }

    public function save(array $options = [])
    {
        return parent::save($options); // TODO: Change the autogenerated stub
    }


    public function doFirstOrCreate(Request $request) {
        $article = Article::firstOrCreate(['title'=> $request->title, 'author'=>$request->author]);
        return $article;
    }

    public function doFirstOrNew(Request $request) {
        $article = Article::firstOrNew(['title'=> $request->title, 'author'=>$request->author]);
        return $article;
    }

    public function doUpdateOrCreate(Request $request){
        $article = Article::updateOrCreate( ['title'=>$request->title], ['title'=>$request->title, 'author'=>$request->author] );
        return $article;
    }

    public function doDelete(Request $request){
        $articles = Article::where(['title'=>$request->title]);
        return $articles->delete();
    }


    public function doDestroy(Request $request){

        $rs = Article::destroy([$request->id]);
        return $rs;
    }

    public function getOnlyTrashed() {
        $rs = Article::onlyTrashed()
            ->where('id', '>', 0)
            ->get();

        return $rs;
    }

    public function unDelete(){
        if($this->trashed()) {
            return $this->restore();
        }
        return true;
    }

    public function doForceDelete(){
        return $this->forceDelete();
    }

    public function getList(){
        return $this->all()->sortByDesc('created_at');
    }



}
