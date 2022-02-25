<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unique();
            $table->integer('nationality_id')->nullable();
            $table->date('born_date')->nullable();
            $table->integer('gender')->default(1);
            $table->date('first_work_date')->nullable();
            $table->date('leave_date')->nullable();
            $table->string('contract_number', 30)->nullable();
            $table->date('contract_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('telegram', 100)->nullable();
            $table->string('avatar', 50)->nullable();
            $table->text('note')->nullable();
            $table->integer('responsible_id')->nullable();
            $table->smallInteger('is_active')->default(1)->comment('1-active ...');
            $table->smallInteger('is_accessible')->default(1)->comment('1 - accessible, 0 - not accessible');
            $table->integer('inn')->nullable();
            $table->bigInteger('inps')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
            $table->index([
                'user_id', 'nationality_id', 'responsible_id', 'responsible_id', 'is_active', 'is_accessible'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropIndex('object_id');
        });
        Schema::dropIfExists('employees');
    }
}
