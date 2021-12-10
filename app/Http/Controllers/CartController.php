<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Cart;
use App\Models\PayMethod;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //Add to cart Process
    public function cartprocess (Request $request) {
        $request->validate([
            'id' => 'required',
            'qty' => 'required',
        ]);
        
        $pro = Product::find($request->id);
        
        $email = Auth::user()->id;
        $p_name = $pro->p_name;
        $p_price = $pro->p_price;
        $price_total = ($p_price * $request->qty);

        $cart = new Cart;
        $cart->pid = $request->id;
        $cart->uid = $email;
        $cart->p_name =  $p_name;
        $cart->p_price = $p_price;
        $cart->qty = $request->qty;
        $cart->price_total = $price_total;
        $cart->save();
        
        return redirect()->route('home');
    }
    //cart page loading
    public function Cart() {
        $user = Auth::user();
        $pay = Paymethod::all();
        $cart = DB::table('carts')->where('uid', $user->id)->get();
        
        return view("cart", ['user' => $user, 'cart' => $cart, 'pay' => $pay]);
    }

    //Cancel a product from cart Process
    public function cancelcart($id) {
        $pay = Cart::find($id);
        $pay->delete();
        return redirect()->route('cart');
    }

    //clear cart Process
    public function clearcart() {
        $uid = Auth::user()->id;
        $cart = DB::table('carts')->where('uid', $uid)->delete();
        return redirect()->route('cart');
    }

    //cart address changing form
    public function address() {
        $user = Auth::user();
        return view("shipping_address", ['user' => $user]);
    }

    //update cart address
    public function updateaddress(Request $request, $id) {
        $request->validate([
            's_address' => 'required',
            's_city' => 'required',
            's_country' => 'required'
        ]);
        $user = User::find($id);
        $user->s_address =  $request->s_address;
        $user->s_city =  $request->s_city;
        $user->s_country =  $request->s_country;
        $user->save();

        return redirect()->route('cart');
    }
}