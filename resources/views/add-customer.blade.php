<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // Display all customers
    public function index()
    {
        $customers = Customer::all(); // Fetch all customers
        return view('customers', compact('customers'));
    }

    // Show the form to add a new customer
    public function create()
    {
        return view('add-customer'); // Ensure this matches your Blade filename
    }

    // Store a newly created customer in the database
    public function store(Request $request)
    {
        \Log::info($request->all()); // Log incoming request data for debugging

        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers,username',
            'email' => 'required|email|unique:customers,email',
            'number' => 'required|string|max:15', // Adjust as necessary
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'password' => 'required|string|min:8', // Adjust as necessary
        ]);

        // Create a new customer instance
        $customer = Customer::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'number' => $request->number,
            'address' => $request->address,
            'age' => $request->age,
            'password' => bcrypt($request->password), // Hash the password
        ]);

        // Redirect back with a success message
        return redirect('/admin/customers')->with('success', 'Customer added successfully!');
    }

    // Update the specified customer
    public function update(Request $request, $id)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:customers,username,' . $id,
            'email' => 'required|email|unique:customers,email,' . $id,
            'number' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
        ]);

        // Find the customer by ID and update their details
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect('/admin/customers')->with('error', 'Customer not found.');
        }

        $customer->name = $request->input('name');
        $customer->username = $request->input('username');
        $customer->email = $request->input('email');
        $customer->number = $request->input('number');
        $customer->address = $request->input('address');
        $customer->age = $request->input('age');
        $customer->save(); // Save changes to the database

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Customer updated successfully!');
    }

    // Optionally, you can add a show method to display a specific customer
    public function show($id)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect('/admin/customers')->with('error', 'Customer not found.');
        }

        return view('show-customer', compact('customer')); // Create a view to display customer details
    }
}
