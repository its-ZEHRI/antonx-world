<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CafeItem;
use Illuminate\Support\Facades\Validator;
use App\Models\CafeItemRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CafeItemRequestController extends Controller
{
    public function payable_amount(Request $request)
    {
        $amount = $request->user()->cafe_bill;

        if (!$amount) {
            return response()->json([
                'success' => false, 'error' => 'No purchase done yet!',
                'body' => []
            ]);
        } else {
            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['amount' => $amount]
            ]);
        }
    }
    function requests_list(Request $request)
    {
        $queryOrder = "CASE WHEN request_status = 'pending' THEN 1 ";
        $queryOrder .= "WHEN request_status = 'accepted' THEN 2 ";
        $queryOrder .= "ELSE 3 END";

        $cafe_items_request = CafeItemRequest::where('user_id', $request->user()->id)
            ->orderByRaw($queryOrder)->get();

        if (count($cafe_items_request) < 0) {
            return response()->json([
                'success' => false, 'error' => 'No Items Request available',
                'body' => []
            ]);
        } else {
            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['cafe_items_request' => $cafe_items_request]
            ]);
        }
    }


    function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required',
        ]);

        $user = User::find($request->user()->id);
        $item = CafeItem::where('brand_name', $request->brand_name)->get();
        $add_item = CafeItemRequest::where('brand_name', $request->brand_name)->get();

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (count($item) > 0) {
            if (slugify($item->first()->brand_name) == slugify($request->brand_name)) {
                return response()->json(['success' => false, 'error' => 'This Item is already added', 'body' => []]);
            }
        }

        if (count($add_item) > 0) {
            if (slugify($add_item->first()->brand_name) == slugify($request->brand_name)) {
                return response()->json(['success' => false, 'error' => 'This Item is already requested will be available soon!', 'body' => []]);
            }
        }

        if ($validator->passes()) {

            $item_image_name = "";
            if ($request->file('item_image')) {
                $file = $request->file('item_image');
                $item_image_name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('/images/cafe_item_images'), $item_image_name);
            }

            $cafe_data = [
                'user_id' => $request->user()->id,
                'brand_name' => $request->brand_name,
                'price' => $request->price,
                'size' => $request->size,
                'item_image' => "https://antonxdemo.com/antonx_world_backend/public/images/book_images/$item_image_name",
                // 'item_image' => "public/images/cafe_item_images/$item_image_name",
            ];
            if (isset($request->id)) {
                CafeItemRequest::where('id', $request->id)->update($cafe_data);
            } else {
                CafeItemRequest::create($cafe_data);
            }

            return response()->json([
                'success' => true,
                'error' => null,
                'body' => ['message' =>  'Request added successfully']
            ]);
        } else {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'body' => []]);
        }
    }
}
