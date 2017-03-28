<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddArticleIdToArticleDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        \Schema::table('article_detail', function (Blueprint $blueprint) {
            $blueprint->integer('article_id')->default(0)->comment('article table primary key value');
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
        \Schema::table('article_detail', function (Blueprint $blueprint) {
            $blueprint->dropColumn('article_id');
        });
    }
}
