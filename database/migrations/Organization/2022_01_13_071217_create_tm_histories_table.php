<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('task_id');
            $table->string('type');
            $table->string('old')->nullable();
            $table->string('new')->nullable();
            $table->integer('user_id');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->index(['task_id', 'user_id']);
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
        Schema::dropIfExists('tm_histories');
    }
}
