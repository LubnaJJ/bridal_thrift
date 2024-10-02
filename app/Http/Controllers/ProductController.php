<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;

class ProductController extends Controller
{
    public function rentProduct(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'user_id' => 'required|exists:users,id',
    ]);

    $product = Product::findOrFail($request->product_id);

    if ($product->quantity < $request->quantity) {
        return response()->json(['message' => 'Not enough stock'], 400);
    }

    Order::create([
        'user_id' => $request->user_id,
        'product_id' => $product->id,
        'quantity' => $request->quantity,
    ]);

    $product->decrement('quantity', $request->quantity);

    return response()->json(['message' => 'Product rented successfully']);
}


public function index()
{
    $products = Product::all(); // Fetch all products
    return view('products', compact('products')); // Pass products to the view
}

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image type and size
        'business_id' => 'required|exists:businesses,id', // Ensure business exists
    ]);
    
    // Handle image upload if exists
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    // Create product
    Product::create([
        'business_id' => $request->business_id,
        'name' => $request->name,
        'description' => $request->description,
        'quantity' => $request->quantity, // Make sure to validate quantity if required
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    return response()->json(['message' => 'Product listed successfully'], 201);
}



}
