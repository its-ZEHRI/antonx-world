<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\BookBorrow;
use App\Models\Book;
use App\Models\User;

class BookBorrowController extends Controller
{
    function index()
    {
        return 0;
    }

    function book_borrow_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'book_id' => 'required',
        ]);
        $user = User::find($request->user()->id);
        $book = Book::find($request->book_id);
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (!$book) {
            return response()->json(['success' => false, 'error' => 'This Book is not available', 'body' => []]);
        }

        if ($validator->passes()) {
            $book_data = [
                'user_id' => $request->user()->id,
                'book_id' => $request->book_id,
            ];
            if (isset($request->id)) {
                BookBorrow::where('id', $request->id)->update($book_data);
            } else {
                BookBorrow::create($book_data);
            }

            return response()->json(['success' => true, 'error' => null, 'body' => ['Request Added Successfully']]);
        } else {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'body' => []]);
        }
    }
}
