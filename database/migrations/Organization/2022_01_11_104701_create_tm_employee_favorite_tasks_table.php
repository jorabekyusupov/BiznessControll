<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmEmployeeFavoriteTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_employee_favorite_tasks', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('task_id');
            $table->unique(["employee_id", "task_id"], 'tm_employee_favorite_task_unique');
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
        Schema::dropIfExists('tm_employee_favorite_tasks');
    }
}
