<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\BookBorrow;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    function index()
    {
        $queryOrder = "CASE WHEN request_status = 'pending' THEN 1 ";
        $queryOrder .= "WHEN request_status = 'accepted' THEN 2 ";
        $queryOrder .= "ELSE 3 END";
        $data['borrow_requests'] = BookBorrow::with(['user', 'book'])
            ->orderByRaw($queryOrder)
            ->get();

        return view('book.book_borrow.book_borrow_request', $data);
    }

    function form(Request $request)
    {
        if (isset($request->id)) {
            $data['book'] =  BookBorrow::where('id', $request->id)->with(['user', 'book'])->get()[0];
        } else {
            $data['book'] = false;
        }
        return view('book.book_borrow.request_remark_form', $data);
    }

    function save_remarks(Request $request)
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
            BookBorrow::where('id', $request->id)->update($book_data);

            $response['status'] = 'Success';
            $response['result'] = 'Remarks Added Successfully';
        } else {
            $response['status'] = 'Success';
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }
}
