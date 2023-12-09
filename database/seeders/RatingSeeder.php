<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        $book = Book::all();

        for ($i = 0; $i < 500000; $i++) {
            $rating = new Rating();
            $rating->value = $faker->numberBetween(1, 10);
            $rating->book_id = $book->random()->id;
            $rating->save();
        }
    }
}
