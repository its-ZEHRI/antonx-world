<?php

namespace App\Http\Controllers;

use App\Models\AddBook;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddBookRequestController extends Controller
{

    function index()
    {
        $queryOrder = "CASE WHEN request_status = 'pending' THEN 1 ";
        $queryOrder .= "WHEN request_status = 'accepted' THEN 2 ";
        $queryOrder .= "ELSE 3 END";
        $data['add_book_requests'] = AddBook::with('user')->orderByRaw($queryOrder)->get();

        return view('book.add_book_request.add_book_request', $data);
    }

    function book_request_form(Request $request)
    {
        if (isset($request->id)) {
            $data['book'] =  AddBook::where('id', $request->id)->with('user')->get()[0];
        } else {
            $data['book'] = false;
        }
        return view('book.add_book_request.request_remark_form', $data);
    }

    function add_book_request(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'book_title' => 'required',
            'description' => 'required'
        ]);
        $user = User::find($request->user_id);
        $book = Book::where('title', $request->book_title)->get();
        $add_book = AddBook::where('book_title', $request->book_title)->get();
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (slugify($book->first()->title) == slugify($request->book_title)) {
            return response()->json(['success' => false, 'error' => 'This Book is already added', 'body' => []]);
        }
        if (slugify($add_book->first()->book_title) == slugify($request->book_title)) {
            return response()->json(['success' => false, 'error' => 'This Book is already requested will be available soon!', 'body' => []]);
        }

        if ($validator->passes()) {
            $book_data = [
                'user_id' => $request->user_id,
                'book_title' => $request->book_title,
                'description' => $request->description,
            ];
            if (isset($request->id)) {
                AddBook::where('id', $request->id)->update($book_data);
            } else {
                AddBook::create($book_data);
            }

            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
        } else {
            $response = ['success' => false, 'error' => $validator->errors(), 'body' => []];
        }
        return response()->json($response);
    }


    function save_request_remark(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'remark' => 'required',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            $book_data = [
                'remarks' => $request->remark,
                'request_status' => $request->status,
                'remark_by' => Auth::user()->id,
            ];
            AddBook::where('id', $request->id)->update($book_data);

            $response['status'] = 'Success';
            $response['result'] = 'Remarks Added Successfully';
        } else {
            $response['status'] = 'Success';
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }
}
