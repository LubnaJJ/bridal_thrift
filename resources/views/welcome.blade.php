<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bridal Thrift</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0; /* Remove default margin */
            background-image: url('/images/banner.jpg'); /* Background image */
            background-size: cover;
            background-position: center;
        }
        .banner {
            height: 100vh; /* Set height to full viewport height */
            display: flex;
            flex-direction: column; /* Allow stacking of elements */
            align-items: center;
            justify-content: center;
            color: white; /* Change text color to contrast the background */
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Banner -->
    <div class="banner">
        <h2 class="text-3xl font-semibold">Welcome to Bridal Thrift</h2>
        <a href="{{ route('dashboard') }}" class="mt-4 px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-300">
            Go to Dashboard
        </a>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-6">
        <div class="max-w-7xl mx-auto text-center">
            <p>&copy; {{ date('Y') }} Bridal Thrift. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
