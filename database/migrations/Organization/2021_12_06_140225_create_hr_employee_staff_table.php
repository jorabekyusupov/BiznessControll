<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrEmployeeStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_employee_staff', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('staff_id');
            $table->integer('is_active')->default(1);
            $table->integer('is_main_staff')->default(0);
            $table->date('enter_date')->nullable();
            $table->date('leave_date')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index('employee_id', 'staff_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_employee_staff', function (Blueprint $table) {
            $table->dropIndex('object_id');
        });
        Schema::dropIfExists('hr_employee_staff');
    }
}
