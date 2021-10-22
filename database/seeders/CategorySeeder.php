<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use CMS\Category\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Schema::disableForeignKeyConstraints();
        \DB::table('categories')->truncate();

        Category::factory(10)->create();

        \Schema::enableForeignKeyConstraints();

    }
}
