<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyArticleUserIdColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('articles', function(Blueprint $blueprint) {
            $blueprint->integer('user_id')->nullable(false)->default(0)->comment('用户id  -1为程序蜘蛛id')->change();
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
        Schema::table('articles', function(Blueprint $blueprint) {
            $blueprint->integer('user_id', false, true)->nullable(false)->default(0)->comment('用户id  -1为程序蜘蛛id')->change();
        });
    }
}
