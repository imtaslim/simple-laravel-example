<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\PayMethod;
use Illuminate\Http\Request;

class PayMethodController extends Controller
{

    //Add PayMethod Form
    public function addpay() {
        $pay = Paymethod::all();
        return view('admin.add_PayMethod', ['pay' => $pay]);
    }

    //Add PayMethod Form Process
    public function addpayProcess(Request $request) {
        $request->validate([
            'pay_name' => 'required'
        ]);


        $cname =  $request->pay_name;

        $pay = new Paymethod;
        $pay->pay_name =  $cname;
        $pay->save();

        return redirect()->route('addpay');
    }

    //Update PayMethod
    public function editpay($id) {
        $pay = Paymethod::find($id);
        return view('admin.edit_PayMethod', ['pay' => $pay]);
    }

    public function updatepay(Request $request, $id) {
        $request->validate([
            'pay_name' => 'required'
        ]);
        $pay = Paymethod::find($id);
        $pay->pay_name =  $request->pay_name;
        $pay->save();

        return redirect()->route('addpay');
    }

    //Delete PayMethod
    public function delpay($id) {
        $pay = Paymethod::find($id);
        $pay->delete();
        return redirect()->route('addpay');
    }
}
