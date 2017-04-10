<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArticleTagRelations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('article_tag_relations', function (Blueprint $blueprint) {

            $blueprint->integer('id', true, true);
            $blueprint->integer('article_id',false, true)->comment('文章id');
            $blueprint->integer('tag_id', false, true)->comment('tag id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('article_tag_relations');
    }
}
