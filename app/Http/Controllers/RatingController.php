<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RatingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'author_id' => 'required|exists:authors,id',
            'rating' => 'required|integer|min:1|max:10',
        ]);

        $book = Book::find($request->input('book_id'));

        if ($book->author_id != $request->input('author_id')) {
            return redirect()->back()->with('error', 'The selected book does not belong to the chosen author.');
        }

        Rating::create([
            'book_id' => $request->input('book_id'),
            'author_id' => $request->input('author_id'),
            'value' => $request->input('rating'),
        ]);

        return redirect()->route('home')->with('success', 'Rating submitted successfully!');
    }

    public function getBooksByAuthor($authorId)
    {
        $books = Book::where('author_id', $authorId)->get();
    
        return response()->json(['books' => $books]);
    }
}
