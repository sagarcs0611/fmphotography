<?php

namespace App\Http\Controllers;

use App\Mail\sendMail;
use App\Models\Client;
use App\Models\ProductMaster;
use App\Models\ProductService;
use App\Models\Proposal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

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

    public function view_add_new_client()
    {
        return view('component.new_client');
    }

    public function add_new_client(Request $request)
    {
        $unique_id = Str::random(8);
        $product_master = new Client();
        $product_master->client_unique_id = $unique_id;
        $product_master->name = $request->client_name;
        $product_master->email = $request->client_email;
        $product_master->ph_no = $request->client_ph;
        $product_master->address = $request->client_address;
        $product_master->save();
        // Session::flash('success', 'Client added successfully!');

        return redirect()->back();
    }

    public function client_list()
    {
        $client_data = Client::all();
        return view('component.client_list', compact('client_data'));
    }

    public function manage_proposal(Request $request)
    {
        $unique_id = $request->uniqueId;
        $get_product_name = ProductMaster::all();
        return view('component.manage-proposal', compact('get_product_name', 'unique_id'));
    }

    public function create_proposal(Request $request)
    {
        $date_a = implode(',', $request->date_a);
        $date_b = implode(',', $request->date_b);
        $client = Client::where('client_unique_id', '=', $request->unique_id)->first();

        $password = Str::random(8);

        $user = new User();
        $user->name = $client->name;
        $user->email = $client->email;
        $user->password = Hash::make($password);
        $user->role = 'user';
        $user->save();

        $user_id = $user->id;

        $proposal = new Proposal();
        $proposal->client_id = $client->client_id;
        $proposal->user_id = $user_id;
        $proposal->package_name = $request->package;
        $proposal->side = $request->side;

        $proposal->client1_name = $request->name_a;
        $proposal->client1_phone = $request->ph_a;
        $proposal->client1_email = $request->email_a;
        $proposal->client1_address = $request->address_a;
        $proposal->client1_date = $date_a;

        $proposal->client2_name = $request->name_b;
        $proposal->client2_phone = $request->ph_b;
        $proposal->client2_email = $request->email_b;
        $proposal->client2_address = $request->address_b;
        $proposal->client2_date = $date_b;
        $proposal->status = '1';
        $proposal->save();



        $data = [
            'Email' => $client->email,
            'Password' => $password
        ];


        Mail::to($client->email)->send(new sendMail($data));

        return redirect()->back();
    }

    public function get_package_details(Request $request)
    {
        $package_details = ProductMaster::where('product_id', '=', $request->product_id)->first();
        return response()->json($package_details->side);
    }

    public function proposal_list()
    {
        // $proposal_list = Proposal::join('users', 'proposal.user_id', '=', 'users.id')->join('product_master', 'proposal.package_name', '=', 'product_master.product_id')->get();
        $proposal_list = Proposal::join('client', 'proposal.client_id', '=', 'client.client_id')->join('product_master', 'proposal.package_name', '=', 'product_master.product_id')->get();
        // dd($proposal_list);
        return view('component.proposal_list', compact('proposal_list'));
    }



}
