<?php

namespace App\Http\Controllers;

use App\Models\CafeItem;
use Illuminate\Support\Facades\Validator;
use App\Models\CafeItemRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CafeItemRequestController extends Controller
{
    function index()
    {
        $queryOrder = "CASE WHEN request_status = 'pending' THEN 1 ";
        $queryOrder .= "WHEN request_status = 'accepted' THEN 2 ";
        $queryOrder .= "ELSE 3 END";
        $data['requested_items'] = CafeItemRequest::with('user')->orderByRaw($queryOrder)->get();

        return view('cafe.add_cafe_item_request.add_cafe_item_request', $data);
    }

    function request_form_with_details(Request $request)
    {
        if (isset($request->id)) {
            $data['cafe_item'] = CafeItemRequest::where('id', $request->id)->with('user')->get()[0];
        } else {
            $data['cafe_item'] = false;
        }
        return view('cafe.add_cafe_item_request.request_item_details', $data);
    }

    function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'brand_name' => 'required',
            'item_image' => 'required'
        ]);
        $user = User::find($request->user_id);
        $item = CafeItem::where('brand_name', $request->brand_name)->get();
        $add_item = CafeItemRequest::where('brand_name', $request->brand_name)->get();
        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (slugify($item->first()->brand_name) == slugify($request->brand_name)) {
            return response()->json(['success' => false, 'error' => 'This Item is already added', 'body' => []]);
        }
        if (slugify($add_item->first()->brand_name) == slugify($request->brand_name)) {
            return response()->json(['success' => false, 'error' => 'This Item is already requested will be available soon!', 'body' => []]);
        }

        if ($validator->passes()) {

            $item_image_name = "";
            if ($request->file('item_image')) {
                $file = $request->file('item_image');
                $item_image_name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('/images/cafe_item_images'), $item_image_name);
            }

            $cafe_data = [
                'user_id' => $request->user_id,
                'brand_name' => $request->bran_name,
                'price' => $request->price,
                'size' => $request->size,
                'item_image' => $item_image_name,
            ];
            if (isset($request->id)) {
                CafeItemRequest::where('id', $request->id)->update($cafe_data);
            } else {
                CafeItemRequest::create($cafe_data);
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
            CafeItemRequest::where('id', $request->id)->update($book_data);

            $response['status'] = 'Success';
            $response['result'] = 'Remarks Added Successfully';
        } else {
            $response['status'] = 'Success';
            $response['result'] = $validator->errors()->toJson();
        }
        return response()->json($response);
    }
}
