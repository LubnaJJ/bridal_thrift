<?php

namespace App\Http\Controllers;

use App\Models\Customer; // Make sure to include the Customer model

class DashboardController extends Controller
{
    public function index()
    {
        $customers = Customer::all(); // Fetch all customers
        return view('dashboard', compact('customers')); // Pass customers to the view
    }
}
