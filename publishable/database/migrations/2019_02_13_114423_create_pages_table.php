<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use KuzyT\Halfdream\Models\Page;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('pages')->onUpdate('cascade')->onDelete('set null');
            \Halfdream::dbJSONField($table, 'title')->nullable();
            \Halfdream::dbJSONField($table, 'content')->nullable();
            \Halfdream::dbJSONField($table, 'image')->nullable();
            \Halfdream::dbJSONField($table, 'gallery')->nullable();
            \Halfdream::dbJSONField($table, 'status')->nullable();
            \Halfdream::dbSEOFields($table);
            $table->integer('order')->default(1);
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
        Schema::dropIfExists('pages');
    }
}
