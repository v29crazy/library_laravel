<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call(UserSeeder::class);
        \App\Models\User::factory(5)->create();
        $this->call(BookSeeder::class);
        \App\Modules\Book\Models\Book::factory(15)->create();

        Schema::enableForeignKeyConstraints();
    }
}
