<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_permissions', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->integer('permission_id');
            $table->unique(['employee_id', 'permission_id'], 'employee_permission_unique');
            $table->index('employee_id', 'permission_id');
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
        Schema::table('mployee_permissions', function (Blueprint $table) {
            $table->dropIndex('object_id');
        });
        Schema::dropIfExists('employee_permissions');
    }
}
