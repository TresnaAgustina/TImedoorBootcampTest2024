<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    public function index()
    {
       // get only 100 books
        $books = Book::paginate(10);

        // count how many ratings each book has
        $books->map(function ($book) {
            $book->rating_count = $book->rating->count();
            return $book;
        });

        // count average rating for each book
        $books->map(function ($book) {
            $book->rating_average = $book->rating->avg('value');
            // round to 1 decimal place
            $book->rating_average = round($book->rating_average, 1);
            return $book;
        });

       return view('pages.Home', compact('books'));
    }

    public function topAuthor()
    {
        // get only 100 books
        $books = Book::get();

        // count how many ratings each book has
        $books->map(function ($book) {
            $book->rating_count = $book->rating->count();
            return $book;
        });

        // count average rating for each book
        $books->map(function ($book) {
            $book->rating_average = $book->rating->avg('value');
            // round to 1 decimal place
            $book->rating_average = round($book->rating_average, 1);
            return $book;
        });

        // sort author by rating average and average rating greater than 5
        $books = $books->sortByDesc('rating_average')->where('rating_average', '>', 5);
        // take only 10 books with highest rating average 
        $books = $books->take(10);

        return view('pages.TopFamousAuthor', compact('books'));
    }


    public function addRating(Request $request){
        // get all book data
        $books = Book::get();
        // get all author data
        $authors = Author::get();

        return view('pages.RatingInput', compact('books', 'authors'));
    }
}
