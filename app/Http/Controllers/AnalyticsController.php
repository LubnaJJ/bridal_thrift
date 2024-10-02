<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function index()
    {
        // Get all businesses with their respective product count and color
        $businesses = Business::withCount('products')->get(); // Adjust 'products' to the relationship name in your model

        // Other data
        $businessCount = $businesses->count(); // Total number of businesses
        $productsByBusiness = Product::selectRaw('business_id, COUNT(*) as total')
            ->with('business')
            ->groupBy('business_id')
            ->get();
        $customerCount = User::count(); // Total number of customers
        $totalProducts = Product::count(); // Total number of products listed

        // Pass the data to the view
        return view('analytics', [
            'businesses' => $businesses,  // Pass businesses data
            'businessCount' => $businessCount,
            'productsByBusiness' => $productsByBusiness,
            'customerCount' => $customerCount,
            'totalProducts' => $totalProducts,
        ]);
    }
}
