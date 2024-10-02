<?php

namespace App\Http\Controllers; // Make sure the namespace is correct

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers',
            'email' => 'required|string|email|max:255|unique:customers',
            'number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|gt:17', // Use 'gt' for greater than
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'age' => $request->age,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($customer, 201);
    }

    public function signin(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $customer = Customer::where('username', $request->username)->first();

        if ($customer && Hash::check($request->password, $customer->password)) {
            return response()->json(['message' => 'Signin successful', 'customer' => $customer]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}
