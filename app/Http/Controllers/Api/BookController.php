<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $books =  Book::with(['category_book.categories', 'review', 'review.user'])->get();
        if (count($books) < 0) {
            return response()->json([
                'success' => false, 'error' => 'No book available',
                'body' => []
            ]);
        } else {
            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['Books' => $books]
            ]);
        }
    }
}
