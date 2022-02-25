<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExtraColumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('extra_columns', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->nullable();
            $table->string('object_type')->nullable();
            $table->string('list_items')->nullable();
            $table->string('default_value')->nullable();
            $table->boolean('is_required')->default(true);
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
        Schema::dropIfExists('extra_columns');
    }
}
