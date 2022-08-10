<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\CafeItemBrandName;
use Illuminate\Support\Facades\Auth;

class cafeItemBrandNameController extends Controller
{
    public function index()
    {
        $data['page_title'] = "AntonX Cafe Item Brand Name";
        $data['brand_list'] = CafeItemBrandName::with(['created_by'])->get();
        return view('cafe.brand_name.item_brand_name_list', $data);
    }
    public function brand_form(Request $request)
    {
        $data['page_title'] = "AntonX Cafe Item Brand Name Form";
        if (isset($request->id)) {
            $data['brand'] =  CafeItemBrandName::where('id', $request->id)->get()[0];
        } else {
            $data['brand'] = false;
        }

        return view('cafe.brand_name.brand_name_form', $data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brand_name' => 'required|unique:cafe_item_brand_names,brand_name,' . $request->id,
        ]);
        if ($validator->passes()) {
            $check = [];
             CafeItemBrandName::where('slug', slugify($request->brand_name))->get();
            if (count($check) > 0) {
                $response['status'] = "Failure";
                $response['result'] = "Record Already Exists";
            } else {

                $brand_data = [
                    'brand_name' => $request->brand_name,
                    'slug' =>  slugify($request->brand_name)
                ];

                if (isset($request->id)) {
                    $brand_data['updated_by'] = Auth::user()->id;
                    CafeItemBrandName::where('id', $request->id)->update($brand_data);
                } else {
                    $brand_data['created_by'] = Auth::user()->id;
                    CafeItemBrandName::create($brand_data);
                }
                $response['status'] = "Success";
                $response['result'] = "Added Successfully";
            }
        } else {
            $response['status'] = "Failure!";
            $response['result'] =  $validator->errors()->toJson();
        }
        return response()->json($response);
    }

    public function delete(Request $request)
    {
        CafeItemBrandName::where('id', $request->id)->delete();
        $response['status'] = "Success";
        $response['result'] = "Deleted Successfully";
        return response()->json($response);
    }
}
