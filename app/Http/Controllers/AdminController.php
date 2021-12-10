<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Admin Dashboard
    public function index() {
        return view("admin.dashboard");
    }

    //Add Category Form
    public function addCat() {
        $categories = Category::all();
        return view('admin.add_category', ['cat' => $categories]);
    }

    //Add Category Form Process
    public function addCatProcess(Request $request) {
        $request->validate([
            'cat_name' => 'required'
        ]);


        $cname =  $request->cat_name;

        $cat = new Category;
        $cat->cat_name =  $cname;
        $cat->save();

        return redirect()->route('addCat');
    }

    //Update Category
    public function editCategory($id) {
        $categories = Category::find($id);
        return view('admin.edit_category', ['cat' => $categories]);
    }

    public function updateCat(Request $request, $id) {
        $request->validate([
            'cat_name' => 'required'
        ]);
        $cat = Category::find($id);
        $cat->cat_name =  $request->cat_name;
        $cat->save();

        return redirect()->route('addCat');
    }

    //Delete category
    public function delCat($id) {
        $categories = Category::find($id);
        $products = DB::table('products')->where('cid', $id)->get();
        foreach ($products as $value) {
           unlink("image/$value->image_path");
        }
        DB::table('products')->where('cid', $id)->delete();
        $categories->delete();
        return redirect()->route('addCat');
    }
}
