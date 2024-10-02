<!-- resources/views/products.blade.php -->
@extends('layouts.basic')

@section('content')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            background-image: url('/images/banner.jpg');
            background-size: cover;
            background-position: center;
        }

        .content {
            margin: 20px;
            padding: 20px;
            min-height: 40vh;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .product-card {
            border: 1px solid #e2e8f0;
            border-radius: 5px;
            padding: 15px;
            margin: 10px;
            display: inline-block;
            width: calc(20% - 20px); /* Five cards per row */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .product-card img {
            width: 200px; /* Set a fixed width */
            height: 200px; /* Set a fixed height */
            object-fit: cover; /* Maintain aspect ratio and cover the area */
            border-radius: 5px;
        }

        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .product-price {
            color: #28a745;
            margin: 5px 0;
        }

        .product-agency {
            font-size: 14px;
            color: #6c757d;
        }
    </style>

    <div class="content">
        <h1>All Products</h1>

        <div class="product-list">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                    <div class="product-name">{{ $product->name }}</div>
                    <div class="product-price">${{ number_format($product->price, 2) }}</div>
                    <div>{{ $product->description }}</div>
                    <div class="product-agency">Listed by: {{ optional($product->business)->name ?? 'Unknown Business' }}</div> <!-- Display agency name -->
                </div>
            @endforeach
        </div>
    </div>
@endsection
