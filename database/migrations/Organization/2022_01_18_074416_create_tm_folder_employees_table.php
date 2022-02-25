<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmFolderEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_folder_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('folder_id');
            $table->integer('employee_id');
            $table->unique(['folder_id', 'employee_id'], 'tm_folder_employee_unique');
            $table->index(['folder_id', 'employee_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_folder_employees');
    }
}
