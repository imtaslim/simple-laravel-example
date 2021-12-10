<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\PayMethod;
use App\Models\Order;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function order() {
        $checkout = Checkout::all();
        return view("admin.all_order", ['che' => $checkout ]);
    }

    public function sin_or(Request $request) {
        $request->validate([
            'id' => 'required',
        ]);
        $checkout = Checkout::find($request->id);
        //get all orders-----------
		$orders = $checkout->order_ids;
		$orders = explode(",", $orders);
		$orders = Order::find($orders);
		// get user details-----------
		$user = User::find($checkout->uid);

        return view("admin.single_order", ['che' => $checkout, 'ord' =>  $orders, 'user' => $user]);
    }
    public function orderCancel(Request $request) {
        $request->validate([
            'id' => 'required',
            'order_status' => 'required',
        ]);
        $checkout = Checkout::find($request->id);
        //get all orders-----------
        if ($request->order_status == 'cancel') {
		    $orders = $checkout->order_ids;
		    $orders = explode(",", $orders);
		    $orders = Order::find($orders);
        
            foreach ($orders as $order) {
            
                $p_stock = DB::table('products')->where('products.id',$order->pid)->get('p_stock');

                foreach ($p_stock as $value) {
                    $current_qty = ($value->p_stock + $order->qty);
                }
                $pro = Product::find($order->pid);
                $pro->p_stock = $current_qty;
                $pro->save();
            }
        }
		
        $checkout->order_status = $request->order_status;
            $checkout->save();
        return redirect()->route("sin_order");
    }

    public function users() {
        $user = User::where('user_type','=','user')->get();
        return view("admin.all_users", ['user' => $user ]);
    }
}