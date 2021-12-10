<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    //Add Product Form
    public function addpro() {
       $pro = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.cid')
            ->get();
        $cat = Category::all();
        return view('admin.add_product', ['pro' => $pro,'cat' => $cat]);
    }

    //Add Product Form Process
    public function addproProcess (Request $request) {

        $request->validate([
            'p_name' => 'required',
            'cid' => 'required',
            'p_price' => 'required',
            'p_desc' => 'required',
            'p_brand' => 'required',
            'p_stock' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg,Gif|max:50000',
        ]);

        $newImageName = time() . '-' . $request->p_name . '.' . $request->image->extension();
	    
		$request->image->move(public_path('image'), $newImageName);
        

        $pro = new Product;
        $pro->p_name =  $request->p_name;
        $pro->cid = $request->cid;
        $pro->p_price = $request->p_price;
        $pro->p_desc = $request->p_desc;
        $pro->p_brand = $request->p_brand;
        $pro->p_stock = $request->p_stock;
        $pro->image_path = $newImageName;
        $pro->save();

        return redirect()->route('addpro');
    }

    //Update Product
    public function editProduct($id) {
        $pro = DB::table('categories')
            ->join('products', 'categories.id', '=', 'products.cid')
            ->where('products.id',$id)
            ->get();
        $cat = Category::all();
        return view('admin.edit_product', ['prod' => $pro, 'cat' => $cat]);
    }

    public function updatepro (Request $request, $id) { 

        if($request->image != "") {
            $request->validate([
                'p_name' => 'required',
                'cid' => 'required',
                'p_price' => 'required',
                'p_desc' => 'required',
                'p_brand' => 'required',
                'p_stock' => 'required',
                'image' => 'required|mimes:jpg,png,jpeg,Gif|max:50000',
            ]);
        }
        else{
            $request->validate([
                'p_name' => 'required',
                'cid' => 'required',
                'p_price' => 'required',
                'p_desc' => 'required',
                'p_brand' => 'required',
                'p_stock' => 'required',
            ]);
        }

        $pro = Product::find($id);
        if($request->image != "") {

        $newImageName = time() . '-' . $request->p_name . '.' . $request->image->extension();
	    
		$request->image->move(public_path('image'), $newImageName);

            //$image_path = public_path("image/$pro->image_path.");

            unlink("image/$pro->image_path");

            $pro->cid = $request->cid;
            $pro->p_name = $request->p_name;
            $pro->p_price = $request->p_price;
            $pro->p_desc = $request->p_desc;
            $pro->p_brand = $request->p_brand;
            $pro->p_stock = $request->p_stock;
            $pro->image_path = $newImageName;
            $pro->save();
        }

        $pro->cid = $request->cid;
        $pro->p_name = $request->p_name;
        $pro->p_price = $request->p_price;
        $pro->p_desc = $request->p_desc;
        $pro->p_brand = $request->p_brand;
        $pro->p_stock = $request->p_stock;
        $pro->save();

        return redirect()->route("addpro");

    }

    //Delete Product
    public function delpro($id) {
        $pro = Product::find($id);
        unlink("image/$pro->image_path");
        $pro->delete();
        return redirect()->route('addpro');
    }
}
