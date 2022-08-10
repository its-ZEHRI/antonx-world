<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CafeItem;
use App\Models\PurchaseCafeItemHistory;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CafeController extends Controller
{
    public function index()
    {
        $cafe_items = CafeItem::with('brand')->get();

        if (count($cafe_items) < 0) {
            return response()->json([
                'success' => false, 'error' => 'No Items available',
                'body' => []
            ]);
        } else {
            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['cafe_items' => $cafe_items]
            ]);
        }
    }
    public function purchase_history(Request $request)
    {
        $purchase_data = PurchaseCafeItemHistory::where('user_id', $request->user()->id)
            ->with('item')->get();

        if (!$purchase_data) {
            return response()->json([
                'success' => false, 'error' => 'No Items Purchased by You yet!!',
                'body' => []
            ]);
        } else {
            return response()->json([
                'success' => true, 'error' => null,
                'body' => ['purchase_data' => $purchase_data]
            ]);
        }
    }

    public function purchase_item(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
        ]);

        $user = User::find($request->user()->id);
        $item = CafeItem::find($request->item_id);

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (!$item) {
            return response()->json(['success' => false, 'error' => 'Sorry! This Item is out of Stock', 'body' => []]);
        }
        if ($item->stock < 1) {
            return response()->json(['success' => false, 'error' => 'Sorry! This Item is out of Stock', 'body' => []]);
        }

        if ($validator->passes()) {

            $cafe_data = [
                'user_id' => $request->user()->id,
                'item_id' => $request->item_id,
                'price' => $item->price,
            ];
            if (isset($request->id)) {
                PurchaseCafeItemHistory::where('id', $request->id)->update($cafe_data);
            } else {
                CafeItem::where('id', $request->item_id)->update(['stock' => $item->stock - 1]);
                User::where('id', $request->user()->id)->update(['cafe_bill' => $request->user()->cafe_bill + $item->price]);
                PurchaseCafeItemHistory::create($cafe_data);
            }

            return response()->json([
                'success' => true,
                'error' => null,
                'body' => ['message' =>  'Enjoy Your Drink, ' . $request->user()->name]
            ]);
        } else {
            return response()->json(['success' => false, 'error' => $validator->errors(), 'body' => []]);
        }
    }


    public function purchase_item_by_cash(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'item_id' => 'required',
        ]);

        $user = User::find($request->user()->id);
        $item = CafeItem::find($request->item_id);

        if (!$user) {
            return response()->json(['success' => false, 'error' => 'Invalid User', 'body' => []]);
        }
        if (!$item) {
            return response()->json(['success' => false, 'error' => 'Sorry! This Item is out of Stock', 'body' => []]);
        }
        if ($item->stock < 1) {
            return response()->json(['success' => false, 'error' => 'Sorry! This Item is out of Stock', 'body' => []]);
        }

        if ($validator->passes()) {

            $cafe_data = [
                'user_id' => $request->user()->id,
                'item_id' => $request->item_id,
                'price' => 0,
            ];
            if (isset($request->id)) {
                PurchaseCafeItemHistory::where('id', $request->id)->update($cafe_data);
            } else {
                CafeItem::where('id', $request->item_id)->update(['stock' => $item->stock - 1]);
                PurchaseCafeItemHistory::create($cafe_data);
            }

            $response = ['success' => true, 'error' => null, 'body' => ['message' => 'Enjoy Your Drink ' . $request->user()->name]];
        } else {
            $response = ['success' => false, 'error' => $validator->errors(), 'body' => []];
        }
        return response()->json($response);
    }
}
