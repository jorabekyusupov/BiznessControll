<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable();
            $table->integer('folder_id')->nullable();
            $table->integer('type_id');
            $table->text('title');
            $table->boolean('is_plan')->default(false);
            $table->integer('status_id')->default(1);
            $table->string('expected_result', 255)->nullable();
            $table->string('actual_result', 255)->nullable();
            $table->integer('expected_duration')->nullable();
            $table->integer('actual_duration')->nullable();
            $table->integer('priority_id')->nullable();
            $table->text('description')->nullable();
            $table->dateTime('begin_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('tm_tasks');
    }
}
