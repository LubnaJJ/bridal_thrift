<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('/images/banner.jpg'); /* Update this path to your image */
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 py-6 flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
            <!-- Logout Option -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-gray-600 hover:text-blue-500">Logout</button>
            </form>
        </div>
    </header>

    <div class="flex-grow py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col items-center">
            <!-- Static cards for dashboard overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
                <!-- Card for Businesses -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-800">Businesses</h3>
                    <p class="mt-2 text-gray-600">Manage your businesses here.</p>
                    <a href="{{ route('admin.businesses.index') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">View Businesses</a>
                </div>

                <!-- Card for Customers -->
                <div class="bg-white p-6 rounded-lg shadow hover:shadow-lg transition-shadow duration-300">
                    <h3 class="text-lg font-semibold text-gray-800">Customers</h3>
                    <p class="mt-2 text-gray-600">Manage your customers here.</p>
                    <a href="{{ route('admin.customers.index') }}" class="mt-4 inline-block bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">View Customers</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
