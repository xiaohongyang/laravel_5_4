<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArticleTypeModel extends Model
{
    //
    protected $table = 'article_type';

    public $fillable = ['name'];

    public $timestamps = false;

    public function create($name) {
        $this->fill(['name' => $name]);
        return $this->save();
    }

}
