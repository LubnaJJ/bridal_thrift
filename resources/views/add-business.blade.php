@extends('layouts.basic')

@section('content')
    <div style="display: flex; justify-content: center; align-items: center; min-height: 100vh; margin: 0; padding: 0; background-image: url('/images/banner.jpg'); background-size: cover; background-position: center; margin-top: -20px; margin-right: -27px; margin-left: -10px;">
        <div style="background: rgba(255, 255, 255, 0.9); padding: 30px; border-radius: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); width: 400px;">
            <h2 style="text-align: center;">Add Business</h2>
            <form method="POST" action="{{ route('admin.businesses.store') }}">
                @csrf
                <!-- Add form fields for business details -->
                <div>
                    <label for="business_name">Business Name:</label>
                    <input type="text" name="business_name" id="business_name" required style="width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required style="width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" id="address" required style="width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div>
                    <label for="phone_number">Phone Number:</label>
                    <input type="text" name="phone_number" id="phone_number" required style="width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required style="width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required style="width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px;">
                </div>
                <div>
                    <button type="submit" style="background-color: #4CAF50; color: white; padding: 10px; border: none; border-radius: 5px; cursor: pointer; width: 100%;">Add Business</button>
                </div>
            </form>
        </div>
    </div>
@endsection
