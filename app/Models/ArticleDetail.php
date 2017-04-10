<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2017/3/28
 * Time: 17:14
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ArticleDetail extends Model
{

    protected $table = 'article_detail';

    public $timestamps = false;

    protected $fillable = ['contents'];


}