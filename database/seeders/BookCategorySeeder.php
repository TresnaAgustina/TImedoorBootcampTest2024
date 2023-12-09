<?php

namespace Database\Seeders;

use App\Models\BookCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class BookCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // book category faker = 3000 data
        $faker = FakerFactory::create();

        for ($i = 0; $i < 300; $i++) {
            $bookCategory = new BookCategory();
            $bookCategory->name = $faker->word();
            $bookCategory->save();
        }

    }
}
