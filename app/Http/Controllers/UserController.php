<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\PayMethod;
use App\Models\Order;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function home(Request $request) {
        $pro = Product::all();
        $join = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.cid')
            ->where('categories.id',$request->id)
            ->get();
        $cat = Category::all();
        return view('welcome', ['pro' => $pro,'cat' => $cat, 'join' => $join]);
    }

    
    public function sin_pro(Request $request) {
        $request->validate([
            'id' => 'required',
        ]);
        $pro = Product::find($request->id);
        return view("single_product", ['pro' => $pro ]);
    }

    public function index() {
        $checkout = Checkout::all();
        return view("dashboard", ['che' => $checkout ]);
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
		$user = Auth::user();

        return view("single_order", ['che' => $checkout, 'ord' =>  $orders, 'user' => $user]);
    }
    public function orderCancel(Request $request) {
        $request->validate([
            'id' => 'required',
            'order_status' => 'required',
        ]);
        $checkout = Checkout::find($request->id);
        //get all orders-----------
		$orders = $checkout->order_ids;
		$orders = explode(",", $orders);
		$orders = Order::find($orders);
        
        foreach ($orders as $order) {
            if ($request->order_status == 'cancel') {
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
        return redirect()->route("sin_or");
    }

}