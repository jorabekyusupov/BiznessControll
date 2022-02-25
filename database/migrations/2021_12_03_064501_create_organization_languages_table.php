<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organization_languages', function (Blueprint $table) {
            $table->id();
            $table->integer('organization_id');
            $table->integer('language_id');
            $table->boolean('is_default')->default('false');
            $table->unique(["organization_id", "language_id"], 'organization_language_unique');
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
        Schema::dropIfExists('organization_languages');
    }
}
