<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmRelatedEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_related_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('relation_type_id')->nullable();
            $table->integer('task_id');
            $table->integer('employee_id');
            $table->integer('staff_id')->nullable();
            $table->integer('expected_duration')->nullable();
            $table->integer('actual_duration')->nullable();
            $table->dateTime('begin_date')->nullable();
            $table->integer('status_id')->default(1);
            $table->index(['task_id', 'employee_id', 'staff_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_related_employees');
    }
}
