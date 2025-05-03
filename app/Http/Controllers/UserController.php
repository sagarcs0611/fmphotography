<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function proposal_details()
    {
        if(Auth::user()->role == 'user')
        {
            $proposal_details = Proposal::join('product_master', 'proposal.package_name', '=', 'product_master.product_id')->join('product_service', 'product_master.product_id', '=', 'product_service.product_id')->where('user_id', '=', Auth::user()->id)->where('proposal.status', '=', '1')->get();
            return view('component.proposal_details', compact('proposal_details'));
        }

    }

    public function payment_history()
    {
        if(Auth::user()->role == 'user')
        {
            return view('component.payment_history');
        }

    }
}
