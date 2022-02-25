<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OauthClientSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(PhrasesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(TaskSeeder::class);
        $this->call(CommentSeeder::class);
    }
}
