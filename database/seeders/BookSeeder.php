<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Author;
use App\Models\BookCategory;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = FakerFactory::create();

        $author = Author::all();
        $category = BookCategory::all();

        for ($i = 0; $i < 100; $i++) {
            $book = new Book();
            $book->title = $faker->sentence(3);
            $book->category_id = $category->random()->id;
            $book->author_id = $author->random()->id;
            $book->save();
        }

    }
}
