<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    public function index() {
      $products = Product::orderBy('id','DESC')->paginate(10);
      return response()->json($products);
    }

    public function showStoreForm(){
        return view('addProduct');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'title' => 'required|string|min:6',
            'description' => 'required|string|min:10',
            'image' => 'required',
        ]);

        $product = new Product();
        $product->title = $request['title'];
        $product->description = $request['description'];

        if($request->hasFile('image')) {

          $file = $request->file('image');

          // keep file extension as well
          $name = $file->getClientOriginalName();
          $generetUniqid =uniqid();
          $file->move(public_path().'/uploads/images/', $generetUniqid.'-'.$name);
          $product->image= env('APP_URL').'/uploads/images/'.$generetUniqid.'-'. $name;

      }

      $product->save();
      return redirect()->back()->with("success","new products is added!");
    }
}
