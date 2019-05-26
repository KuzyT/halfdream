<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('user_id')->unsigned()->nullable()->default(null);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
            $table->integer('category_id')->unsigned()->nullable()->default(null);
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('set null');
            \Halfdream::dbJSONField($table, 'title')->nullable();
            \Halfdream::dbJSONField($table, 'content')->nullable();
            \Halfdream::dbJSONField($table, 'image')->nullable();
            \Halfdream::dbJSONField($table, 'gallery')->nullable();
            \Halfdream::dbJSONField($table, 'status')->nullable();
            \Halfdream::dbJSONField($table, 'published_at')->nullable();
            \Halfdream::dbSEOFields($table);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
