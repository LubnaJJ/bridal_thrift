<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BusinessController extends Controller
{
    public function index()
    {
        // Fetch all businesses from the database
        $businesses = Business::all();

        // Pass the businesses to the view
        return view('businesses', compact('businesses'));
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

        // Create a new business
        Business::create([
            'business_name' => $request->business_name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'username' => $request->username,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Business registered successfully.');
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
        // Return view for managing businesses
        $businesses = Business::all(); // Fetch all businesses
        return view('manage-businesses', compact('businesses')); // Ensure this view exists
    }

    public function destroy($id)
{
    // Find the business by ID
    $business = Business::find($id);

    if ($business) {
        $business->delete(); // Delete the business
        return response()->json(['message' => 'Business deleted successfully.'], 200);
    } else {
        return response()->json(['message' => 'Business not found.'], 404);
    }
}

}
