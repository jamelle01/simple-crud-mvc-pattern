<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        // Get all products from the database and order them by their creation date
        $products = Product::orderby('created_at')->get();
        
        // Pass the products to the 'products.index' view and return it
        return view('products.index',  ['products' => $products]);
    }

    public function create(){
        // Show the 'products.create' view
        return view('products.create');
    }
    
    public function store(Request $request){
        // Validate the request data to ensure it meets the required criteria
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2028'
        ]);
        
        // Create a new instance of the Product model
        $product = new Product;

        // Generate a unique file name for the image using the current time and its original extension
        $file_name = time() . '.' . request()->image->getClientOriginalExtension();
        
        // Move the uploaded image to the public 'image' directory with the generated file name
        request()->image->move(public_path('image'), $file_name);

        // Set the attributes of the product with the request data
        $product->name = $request->name;
        $product->description = $request->description;
        $product->image = $file_name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        
        // Save the product to the database
        $product->save();
        
        // Redirect the user to the 'products.index' route with a success message
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');

    }
    
}
