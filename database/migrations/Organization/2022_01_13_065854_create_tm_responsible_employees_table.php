<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmResponsibleEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_responsible_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('relation_type')->nullable();
            $table->integer('task_id');
            $table->integer('employee_id');
            $table->integer('staff_id')->nullable();
            $table->index(['task_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tm_responsible_employees', function (Blueprint $table) {
            $table->dropIndex(['task_id', 'employee_id']);
        });
        Schema::dropIfExists('tm_responsible_employees');
    }
}
