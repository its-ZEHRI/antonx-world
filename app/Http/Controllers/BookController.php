<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\BookCategoryRelation;
use App\Models\BookCategory;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('role');
    }

    public function index()
    {
        $data['page_title'] = "AntonX- Books List";
        $data['categories'] = BookCategory::get();
        $data['books'] = Book::with(['category_book', 'category_book.category_list'])->get();

        return view('book.books', $data);
    }

    function show_books_with_review()
    {
        $data['books'] =  Book::with(['category_book.category_list', 'review', 'review.user'])->get();

        return view('book.book_with_reviews', $data);
    }

    public function book_form(Request $request)
    {

        $data['page_title'] = "Book Form";
        $data['category_list'] = BookCategory::with('book_category')->get();
        $data['category_rel'] = BookCategoryRelation::with('category_list')->get();
        if (isset($request->id)) {
            $data['book'] =  Book::where('id', $request->id)->get()[0];
        } else {
            $data['book'] = false;
        }

        return view('book.book_form', $data);
    }

    public function store(Request $request)
    {
        if (($request->book_type == 'soft copy' || $request->book_type == 'both') && ($request->book_link == '' || $request->book_file == '')) {

            $response['status'] = 'Failure';
            $response['result'] = 'Please add link or soft copy (file) for this book';
        }

        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'author' => 'required',
            'summary' => 'required|unique:books,summary,' . $request->id,
            'book_type' => 'required',
            'book_image' => 'image|mimes:png,gif,jpeg,jpg,|max:2048',
        ]);

        if ($validator->passes()) {
            $book_data = [
                'title' => $request->title,
                'author' => $request->author,
                'summary' => $request->summary,
                'book_type' => $request->book_type,
                'book_link' => $request->book_link,
            ];

            if ($request->file('book_image')) {
                $book_image_name = "";
                $file = $request->file('book_image');
                $book_image_name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('/images/book_images'), $book_image_name);
                $book_data['book_image'] = request()->getSchemeAndHttpHost() . "/public/images/book_images/$book_image_name";
            }

            if ($request->file('book_file')) {
                $book_file_upload = "";
                $file = $request->file('book_file');
                $book_file_upload = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('/book_files'), $book_file_upload);
                $book_data['book_file'] = request()->getSchemeAndHttpHost() . "/public/book_files/$book_file_upload";
            }


            if (isset($request->id)) {

                $book_data['updated_by'] = Auth::user()->id;
                Book::where('id', $request->id)->update($book_data);

                $record = BookCategoryRelation::where('book_id', $request->id)->get();
                if (count($record) > 0) {
                    foreach ($record as $rec) {
                        $rec->delete();
                    }
                }

                foreach ($request->category as $key) {
                    BookCategoryRelation::create(array(
                        'category_id' => $key['id'],
                        'book_id' => $request->id,

                    ));
                }
            } else {

                $book_data['created_by'] = Auth::user()->id;
                Book::create($book_data);

                $book_id = Book::orderBy('id', 'desc')->get();
                foreach ($request->category as $key) {
                    BookCategoryRelation::create(array(
                        'category_id' => $key['id'],
                        'book_id' => $book_id->first()->id,

                    ));
                }
            }

            $response['status'] = 'Success';
            $response['result'] = 'Added Successfully';
        } else {
            $response['status'] = 'Failure';
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        $user = Book::find($request->id);
        $user->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";


        return response()->json($response);
    }
}
