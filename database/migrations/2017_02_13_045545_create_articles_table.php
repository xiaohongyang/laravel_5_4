<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->charset='utf8';
            $table->collation = 'utf8_general_ci';

            $table->increments('id');
            $table->char('title', 255)->nullable(false)->default('')->comment('标题')->collation('utf8_general_ci');
            $table->char('author', 80)->nullable(false)->default('')->comment('作者b')->collation('utf8_general_ci');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
