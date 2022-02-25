<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hr_positions', function (Blueprint $table) {
            $table->id();
            $table->integer('position_type_id')->default(1);
            $table->string('code', 15)->default('000');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->index('position_type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hr_positions', function (Blueprint $table) {
            $table->dropIndex('object_id');
        });
        Schema::dropIfExists('hr_positions');
    }
}
