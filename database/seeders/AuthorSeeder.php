<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;
use Faker\Factory as FakerFactory;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // author faker = 1000 data
        $faker = FakerFactory::create();

        for ($i = 0; $i < 100; $i++) {
            $author = new Author();
            $author->name = $faker->name;
            $author->save();
        }
    }
}
