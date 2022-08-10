<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddBook;
use App\Models\Book;
use App\Models\User;

class AddBookRequestController extends Controller
{

    function index()
    {
        return 0;
    }

    function add_book_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_title' => 'required',
            'description' => 'required'
        ]);
        $user = User::find($request->user()->id);
        $book = Book::where('title', $request->book_title)->get();
        $add_book = AddBook::where('book_title', $request->book_title)->get();

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (count($book) > 0) {
            if (slugify($book->first()->title) == slugify($request->book_title)) {
                return response()->json(['success' => false, 'error' => 'This Book is already added', 'body' => []]);
            }
        }
        if (count($add_book) > 0) {
            if (slugify($add_book->first()->book_title) == slugify($request->book_title)) {
                return response()->json(['success' => false, 'error' => 'This Book is already requested will be available soon!', 'body' => []]);
            }
        }

        if ($validator->passes()) {
            $book_data = [
                'user_id' => $request->user()->id,
                'book_title' => $request->book_title,
                'category' => $request->category,
                'description' => $request->description,
            ];
            if (isset($request->id)) {
                AddBook::where('id', $request->id)->update($book_data);
            } else {
                AddBook::create($book_data);
            }

            return response()->json(['success' => true, 'error' => null, 'body' => ['Added Successfully']]);
        } else {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'body' => []]);
        }
    }
}
