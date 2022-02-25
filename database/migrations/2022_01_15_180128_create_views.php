<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateViews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared(file_get_contents(base_path().'/database/seeders/sql/modules.sql'));
        DB::unprepared(file_get_contents(base_path().'/database/seeders/sql/pages.sql'));
        DB::unprepared(file_get_contents(base_path().'/database/seeders/sql/nationality.sql'));

        DB::statement(file_get_contents(base_path().'/database/views/create_master_phrases_view.sql'));
        DB::statement(file_get_contents(base_path().'/database/views/create_user_organizations_view.sql'));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement(file_get_contents(base_path().'/database/views/drop_master_phrases_view.sql'));
        DB::statement(file_get_contents(base_path().'/database/views/drop_user_organizations_view.sql'));
    }
}
