<?php

namespace App\Http\Controllers;

use App\Models\BookCategory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    public function index()
    {
        $data['page_title'] = "AntonX - Book Categories";
        $data['book_categories'] = BookCategory::with('creator')->get();
        return view('book.category.book_categories', $data);
    }
    public function book_category_form(Request $request)
    {
        $data['page_title'] = "Book Category Form";
        if (isset($request->id)) {
            $data['category'] =  BookCategory::where('id', $request->id)->get()[0];
        } else {
            $data['category'] = false;
        }

        return view('book.category.category_form', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);
        if ($validator->passes()) {
            $check = BookCategory::where('title', $request->title)->get();
            if (count($check) > 0) {
                $response['status'] = "Failure";
                $response['result'] = "Record Already Exists";
            } else {

                $category = [
                    'title' => $request->title,
                    'description' => $request->description,
                ];

                if (isset($request->id)) {
                    $category['updated_by'] = Auth::user()->id;
                    BookCategory::where('id', $request->id)->update($category);
                } else {
                    $category['created_by'] = Auth::user()->id;
                    BookCategory::create($category);
                }
                $response['status'] = "Success";
                $response['result'] = "Added Successfully";
            }
        } else {
            $response['status'] = "Failure!";
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        BookCategory::where('id', $request->id)->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";
        return response()->json($response);
    }
}
