<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PhrasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::unprepared(file_get_contents(base_path().'/database/seeders/sql/phrases.sql'));
        DB::unprepared(file_get_contents(base_path().'/database/seeders/sql/phrase_translations.sql'));
    }
}
