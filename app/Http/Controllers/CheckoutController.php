<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\PayMethod;
use App\Models\User;
use App\Models\Order;
use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutprocess (Request $request) {
        $request->validate([
            'shipping_cost' => 'required',
            'final_total' => 'required',
            'pay_name' => 'required',
        ]);
        
        
	$uid = Auth::user()->id;

	$cart = DB::table('carts')->where('uid', $uid)->get();
    

	// insert into Order table ---
	foreach ($cart as $value) {
        $order = new Order;
        $order->pid = $value->pid;
        $order->uid = $uid;
        $order->p_name =  $value->p_name;
        $order->p_price = $value->p_price;
        $order->qty = $value->qty;
        $order->price_total = $value->price_total;
        $order->save();


		//substract stock
		$pro = Product::find($value->pid);

		$current_stock = ($pro->p_stock - $value->qty);
		$pro->p_stock = $current_stock;
        $pro->save();
	}

	// delete cart ---
    DB::table('carts')->where('uid', $uid)->delete();

	// get order ids ---
    $order = DB::table('orders')->where('uid', $uid)->latest()->get();
    
    $time = $order[0]->created_at;

    $order = DB::table('orders')->where('uid', $uid)->where('created_at', $time)->get('id');

    $order_ids = "";
	foreach ($order as $value) {
		$order_ids .= $value->id.",";
	}
	$order_ids = substr($order_ids, 0,-1);


	// Insert into check out
	$checkout = new Checkout;
        $checkout->order_ids = $order_ids;
        $checkout->uid = $uid;
        $checkout->shipping_cost =  $request->shipping_cost;
        $checkout->pay_method = $request->pay_name;
        if ($request->courier) {
            $checkout->courier = $request->courier;
        }
        
        $checkout->final_total = $request->final_total;
        $checkout->save();
	
    $checkout = DB::table('checkouts')->where('uid', $uid)->latest()->get();
    
    $time = $checkout[0]->created_at;

    $checkout = DB::table('checkouts')->where('uid', $uid)->where('created_at', $time)->get('id');

		

		
	
	
    
        
        return redirect()->route('home', ['msg' => "Thanks For Your Order"]);
    }
}