<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleTagsModel;

class ArticleTagRelationsModel extends Model
{
    //

    public $timestamps = false;

    protected $table = 'article_tag_relations';

    public function tag(){
        return $this->belongsTo(ArticleTagsModel::class, 'tag_id');
    }

    public function article() {
        return $this->belongsTo(Article::class, 'article_id');
    }

    public function create(Article $article, ArticleTagsModel $tag) {
        $tagRelationModel = new Static();
        $tagRelationModel->article_id = $article->id;
        $tagRelationModel->tag_id = $tag->id;
        return $tagRelationModel->save();
    }
}
