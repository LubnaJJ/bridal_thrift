<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Product;

class BusinessController extends Controller
{
    public function update(Request $request, $id)
    {
        $request->validate([
            'business_name' => 'required|string|max:255',
            'email' => 'required|email',
            'address' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'username' => 'required|string|max:255',
        ]);
        
        try {
            $business = Business::findOrFail($id);
            $business->update($request->all());
            return redirect()->route('business.index')->with('success', 'Business updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('business.index')->with('error', 'Failed to update business: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $businesses = Business::all();
        return view('businesses', compact('businesses'));

        $products = Product::with('business')->get(); // Make sure to use 'business' here
        
        return view('products', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'business_name' => 'required|string',
            'email' => 'required|string|email|unique:businesses',
            'address' => 'required|string',
            'phone_number' => 'required|string',
            'username' => 'required|string|unique:businesses',
            'password' => 'required|string|min:6',
        ]);

        try {
            Business::create([
                'business_name' => $request->business_name,
                'email' => $request->email,
                'address' => $request->address,
                'phone_number' => $request->phone_number,
                'username' => $request->username,
                'password' => Hash::make($request->password),
            ]);
            return redirect()->back()->with('success', 'Business registered successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to register business: ' . $e->getMessage());
        }
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $business = Business::where('username', $request->username)->first();

        if (!$business || !Hash::check($request->password, $business->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // Consider storing session information here

        return response()->json(['message' => 'Login successful', 'business' => $business], 200);
    }

    public function show($id)
    {
        $business = Business::with('products')->findOrFail($id);
        return response()->json($business);
    }

    public function analytics()
    {
        $businesses = Business::withCount('products')->get();
        return view('analytics', compact('businesses'));
    }

    public function manage()
    {
        $businesses = Business::all();
        return view('manage-businesses', compact('businesses'));
    }

    public function destroy($id)
    {
        $business = Business::find($id);

        if ($business) {
            $business->delete();
            return response()->json(['message' => 'Business deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Business not found.'], 404);
        }
    }

    public function signup(Request $request)
    {
        $validatedData = $request->validate([
            'business_name' => 'required|string|max:255',
            'username' => 'required|string|unique:businesses,username|max:255',
            'email' => 'required|email|unique:businesses,email|max:255',
            'number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'password' => 'required|string|min:8|confirmed',
        ]);

        try {
            $business = Business::create([
                'business_name' => $validatedData['business_name'],
                'username' => $validatedData['username'],
                'email' => $validatedData['email'],
                'number' => $validatedData['number'],
                'address' => $validatedData['address'],
                'age' => $validatedData['age'],
                'password' => bcrypt($validatedData['password']),
            ]);

            return response()->json(['message' => 'Business created successfully!', 'business' => $business], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create business: ' . $e->getMessage()], 400);
        }
    }
}
