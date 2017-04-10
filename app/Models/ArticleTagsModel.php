<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTagsModel extends Model
{
    //

    public $timestamps = false;

    protected $table = 'article_tags';

    protected $fillable = ['name'];


    public function tagRelations() {
        $this->hasMany(ArticleTagRelationsModel::class, 'article_id', 'id');
    }

    public function create($tagName) {
        $model = new ArticleTagsModel();
        $model->name = $tagName;
        return $model->save();
    }

}
