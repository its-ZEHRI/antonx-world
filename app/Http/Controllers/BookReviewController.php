<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\BookReview;
use App\Models\User;

class BookReviewController extends Controller
{

    function index(){
        return 0;
    }

    function add_book_review(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'book_id' => 'required',
            'comment' => 'required',
            'rating' => 'required',
        ]);
        $user = User::find($request->user_id);
        $book = Book::find($request->book_id);
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (!$book) {
            return response()->json(['success' => false, 'error' => 'Invalid Book', 'body' => []]);
        }

        if ($validator->passes()) {
            $book_data = [
                'user_id' => $request->user_id,
                'book_id' => $request->book_id,
                'comment' => $request->comment,
                'rating' => $request->rating,
            ];
            if (isset($request->id)) {
                BookReview::where('id', $request->id)->update($book_data);
            } else {
                BookReview::create($book_data);
            }

            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
        } else {
            $response = ['success' => false, 'error' => $validator->errors(), 'body' => []];
        }
        return response()->json($response);
    }
    
}
