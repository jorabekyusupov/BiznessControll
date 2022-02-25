<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_staff', function (Blueprint $table) {
            $table->id();
            $table->integer('department_id');
            $table->integer('position_id');
            $table->integer('is_active')->default(1);
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['department_id', 'position_id'], 'staff_department_id_position_id');
            $table->index('department_id', 'position_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_staff', function (Blueprint $table) {
            $table->dropIndex('object_id');
        });
        Schema::dropIfExists('hr_staff');
    }
}
