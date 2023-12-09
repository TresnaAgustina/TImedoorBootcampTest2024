<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request){
        // Post count per page
        $perPage = (int) $request->input('post-count', 10); // Default 10

        $searchQuery = $request->input('search-text');

        $books = Book::with(['author', 'category']);

        // get the book rating
        $books->withCount([
            'rating as rating_average' => function ($query) {
                $query->select(\DB::raw('coalesce(avg(value),0)'));
                // round to 1 decimal place
            },
            'rating as rating_count' => function ($query) {
                $query->select(\DB::raw('coalesce(count(*),0)'));
            }
        ]);

        // Apply search filters
        if ($searchQuery) {
            $books->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', "%$searchQuery%")
                    ->orWhereHas('author', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', "%$searchQuery%");
                    })
                    ->orWhereHas('category', function ($query) use ($searchQuery) {
                        $query->where('name', 'like', "%$searchQuery%");
                    });
            });
        }

        $books = $books->paginate($perPage); // Paginate results
        

        return view('pages.Home', compact('books', 'searchQuery'));
    }

}
