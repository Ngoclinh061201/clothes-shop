<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    public function index(Request $request){
        if(!empty($request->search)){
            $bills = Bills::where('recipient_name', 'like', '%'.$request->search.'%')
                ->orWhere('number_phone', 'LIKE', '%' . $request->search . '%')
                ->orWhere('user_order_id', 'LIKE', '%' . $request->search . '%')
                ->orWhere('address_detail', 'LIKE', '%' . $request->search . '%')
                ->get();
        }
        else{
            $bills = Bills::all();
        }
        return view('admin.pages.bill.list-order', compact('bills'));
    }
}
