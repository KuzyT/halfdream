<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use KuzyT\Halfdream\Models\Icon;

class CreateIconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('icons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('icon');
            \Halfdream::dbJSONField($table, 'title')->nullable();
            \Halfdream::dbJSONField($table, 'image')->nullable();
            \Halfdream::dbJSONField($table, 'svg')->nullable();
            $table->enum('type', Icon::getTypes());
            $table->unique(['icon', 'type'], 'unique_pair');
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
        Schema::dropIfExists('icons');
    }
}
