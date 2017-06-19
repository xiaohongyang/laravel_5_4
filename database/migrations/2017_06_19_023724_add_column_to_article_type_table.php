<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToArticleTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('article_type', function(Blueprint $blueprint){
            $blueprint->integer('uid')->comment('创建者用户id')->nullable(false)->default(0);
            $blueprint->integer('pid')->comment('上级id')->nullable(false)->default(0);
            $blueprint->timestamps();
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
        Schema::table('article_type', function(Blueprint $blueprint){

            $blueprint->dropColumn('uid','pid');
            $blueprint->dropTimestamps();
        });
    }
}
