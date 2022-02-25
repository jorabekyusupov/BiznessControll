<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmTaskTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_task_tags', function (Blueprint $table) {
            $table->id();
            $table->integer('tag_id');
            $table->integer('task_id');
            $table->unique(["tag_id", "task_id"], 'tm_task_tag_unique');
            $table->index(['tag_id', 'task_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tm_task_tags', function (Blueprint $table) {
            $table->dropIndex(['tag_id', 'task_id']);
        });
        Schema::dropIfExists('tm_task_tags');
    }
}
