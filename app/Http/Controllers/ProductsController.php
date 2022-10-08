<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Log;

class ProductsController extends Controller
{
    public function allProducts()
    {
        $products = Product::all();
        return response()->json(['products'=>$products], 200);

    }

    public function singleProduct($product_id)
    {
        $products = Product::find($product_id);
        return response()->json(['products'=>$products], 200);
    }

    public function searchProduct($title)
    {
        $products = Product::where('title', 'LIKE', '%'. $title. '%')->get();
        if($products)
        {
            return response()->json(['products'=>$products], 200);
        }
        else
        {
            return response()->json(['message'=>'Try again, Product not found.'], 404);
        }
    }
    
    public function allCategory(){
        $products = Product::select('category')->get();
        $categories = array();
        foreach($products as $product){
            array_push($categories, $product['category']);
        }
        return response()->json(['categories'=>$categories], 200);
    }


    public function categoryProduct($category_name)
    {
        $products = Product::where('category', $category_name)->get();
        return response()->json(['products'=>$products], 200);
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'currency' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'image' => 'required',
        ]);

        $product = new Product;
        $product ->title = $request->title;
        $product ->description = $request->description;
        $product ->currency = $request->currency;
        $product ->price = $request->price;
        $product ->brand = $request->brand;
        $product ->category = $request->category;
        $product ->image = $request->image;
        $product ->save();
        return response()->json(['message'=>'Product was successfully added'], 200);
    }
    
    public function updateProduct(Request $request, $product_id)
    {
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'currency'=>'required',
            'price'=>'required',
            'brand'=>'required',
            'category'=>'required',
            'image'=>'required'
        ]);

        $products = Product::find($product_id);
        $products->title = $request->title;
        $products->description = $request->description;
        $products->currency = $request->currency;
        $products->price = $request->price;
        $products->brand = $request->brand;
        $products->category = $request->category;
        $products->image = $request->image;
        $products->update();
        return response()->json(['message'=>'Successfully updated Product'], 200);
    }

    public function deleteProduct(Request $request, $id)
    {
        $products = Product::find($id);
        $products->delete();
        return response()->json(['message'=>'Product Deleted'], 200);
    }
}