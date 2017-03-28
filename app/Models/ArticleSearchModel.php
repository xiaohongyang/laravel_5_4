<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ArticleSearchModel extends Model
{
    //

    protected $table = 'articles';


    public function getList(\Request $request) {

        $query = Article::where('created_at', '<>', null);
        $query->orderBy('updated_at', 'desc');

        return $query->Paginate(15);;
    }

    public function authorUser(){
        return $this->hasOne(User::cleass, 'author');
    }

}
