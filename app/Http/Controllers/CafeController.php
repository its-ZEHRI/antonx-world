<?php

namespace App\Http\Controllers;

use App\Models\CafeItem;
use App\Models\CafeItemBrandName;
use App\Models\PurchaseCafeItemHistory;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CafeController extends Controller
{
    public function index()
    {

        $data['page_title'] = "AntonX- Cafe Item List";
        $data['cafe_items'] = CafeItem::with('brand')->get();

        return view('cafe.cafe_item_list', $data);
    }

    public function purchase_history()
    {
        $data['purchased_items'] = PurchaseCafeItemHistory::with(['user', 'item'])->get();
        return view('cafe.purchase_history.purchase_history_list', $data);
    }
    public function form(Request $request)
    {
        $data['page_title'] = "Cafe Item Form";

        $data['brands'] = CafeItemBrandName::get();
        if (isset($request->id)) {
            $data['item'] =  CafeItem::where('id', $request->id)->get()[0];
        } else {
            $data['item'] = false;
        }

        return view('cafe.cafe_item_form', $data);
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_id' => 'required',
            'price' => 'required',
            'item_name' => 'required|unique:cafe_items,item_name,' . $request->id,
            'stock' => 'required',
            'size' => 'required',
            'item_image' => 'image|mimes:png,gif,jpeg,jpg,|max:2048',
        ]);

        if ($validator->passes()) {

            $item_data = [
                'brand_id' => $request->brand_id,
                'item_name' => $request->item_name,
                'price' => $request->price,
                'stock' => $request->stock,
                'size' => $request->size,

            ];

            if ($request->file('item_image')) {
                $item_image_name = "";
                $file = $request->file('item_image');
                $item_image_name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('/images/cafe_item_images'), $item_image_name);
                $item_data['item_image'] = request()->getSchemeAndHttpHost() . "/public/images/cafe_item_images/$item_image_name";
            }


            if (isset($request->id)) {

                $item_data['updated_by'] = Auth::user()->id;
                CafeItem::where('id', $request->id)->update($item_data);
            } else {

                $item_data['created_by'] = Auth::user()->id;
                CafeItem::create($item_data);
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

        $user = CafeItem::find($request->id);
        $user->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";

        return response()->json($response);
    }
}
