<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use KuzyT\Halfdream\Models\MenuItem;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('menu_id')->unsigned();
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade');
            $table->integer('parent_id')->unsigned()->nullable()->default(null);
            $table->foreign('parent_id')->references('id')->on('menu_items')->onUpdate('cascade')->onDelete('set null');
            \Halfdream::dbJSONField($table, 'title')->nullable();
            \Halfdream::dbJSONField($table, 'url')->nullable();
            \Halfdream::dbJSONField($table, 'route')->nullable();
            \Halfdream::dbJSONField($table, 'parameters')->nullable();
            \Halfdream::dbJSONField($table, 'visible')->nullable();
            $table->enum('target', MenuItem::getTargets())->default(MenuItem::getDefaultTarget());
            $table->integer('icon_id')->unsigned()->nullable()->default(null);
            $table->foreign('icon_id')->references('id')->on('icons')->onUpdate('cascade')->onDelete('set null');
            $table->string('color')->nullable();
            $table->string('class')->nullable();
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
        Schema::dropIfExists('menu_items');
    }
}