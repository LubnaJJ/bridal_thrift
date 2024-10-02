<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import the Hash facade
use Illuminate\Support\Facades\Log;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers', compact('customers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers,username,' . $id,
            'email' => 'required|email|unique:customers,email,' . $id,
            'number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
        ]);

        $customer = Customer::findOrFail($id);
        $customer->update($request->all());

        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers',
            'email' => 'required|string|email|max:255|unique:customers',
            'number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'age' => 'required|integer',
            'password' => 'required|string|min:8', // Validate password
        ]);

        Customer::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'age' => $request->age,
            'password' => Hash::make($request->password), // Hash the password
        ]);

        return redirect()->back()->with('success', 'Customer created successfully.');
    }

    public function destroy($id)
    {
        // Find the customer by ID
        $customer = Customer::find($id);

        if ($customer) {
            $customer->delete(); // Delete the customer
            return response()->json(['message' => 'Customer deleted successfully.'], 200);
        } else {
            return response()->json(['message' => 'Customer not found.'], 404);
        }
    }

    public function edit($id)
{
    // Find the customer by ID
    $customer = Customer::findOrFail($id);

    // Return the view with the customer data
    return view('edit_customer', compact('customer'));
}




}
