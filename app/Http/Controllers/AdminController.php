<?php

namespace App\Http\Controllers;

use App\Models\ProductMaster;
use App\Models\ProductService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function product()
    {
        // $product_data = ProductMaster::join('product_service', 'product_master.product_id', '=', 'product_service.product_id')->get();
        $product_data = ProductMaster::all();
        return view('component.product', compact('product_data'));
    }

    public function dashboard()
    {
        return view('component.dashboard');
    }

    public function view_add_new_product()
    {
        return view('component.new_product');
    }

    public function add_new_product(Request $request)
    {
        $product_master = new ProductMaster();
        $product_master->product_name = $request->product_name;
        $product_master->short_description = $request->description;
        $product_master->price = $request->price;
        $product_master->save();
        $product_id = $product_master->id;

        foreach($request->service_name as $service)
        {
            $product_service = new ProductService();
            $product_service->product_id = $product_id;
            $product_service-> service_name = $service;
            $product_service->save();
        }
        return redirect()->back();
    }

    public  function get_edit_data(Request $request)
    {
        $product_servics = ProductService::where('product_id', '=', $request->productId)->get();
        return response()->json($product_servics);

    }

    public function update_edit_data(Request $request)
    {

        // Delete previous item
        $service_data_delete = ProductService::where('product_id', $request->productId)->delete();
        $product_data_delete = ProductMaster::where('product_id', $request->productId)->delete();

        // Add new item
        $product_master = new ProductMaster();
        $product_master->product_name = $request->productName;
        $product_master->short_description = $request->productDescription;
        $product_master->price = $request->productPrice;
        $product_master->save();
        $product_id = $product_master->id;

        foreach($request->productServices as $service)
        {
            $product_service = new ProductService();
            $product_service->product_id = $product_id;
            $product_service-> service_name = $service;
            $product_service->save();
        }
        return response()->json('Item add successfully');
    }

    public function delete_product_data(Request $request)
    {
        // dd($request->productId);
        $service_data_delete = ProductService::where('product_id', $request->productId)->delete();
        $product_data_delete = ProductMaster::where('product_id', $request->productId)->delete();
        return response()->json('Item delete successfully');
    }

    public function manage_proposal(Request $request)
    {
        $get_product_name = ProductMaster::all();
        return view('component.manage-proposal', compact('get_product_name'));
    }

}
