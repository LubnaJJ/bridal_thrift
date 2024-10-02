@extends('layouts.basic')

@section('content')
    <style>
        /* Ensure the body takes up the full height and removes default margins */
        html, body {
            height: 100%;
            margin: 0;
            background-image: url('/images/banner.jpg');
            background-size: cover; /* Cover the entire screen */
            background-position: center; /* Center the background image */
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px; /* Width of the sidebar */
            background-color: rgba(45, 55, 72, 0.9); /* Sidebar color */
            color: white;
            height: 100vh; /* Full height of the viewport */
            position: fixed; /* Fixed position */
            padding: 20px;
            z-index: 1000; /* Ensure it is on top */
        }

        /* Main content container */
        .content {
            margin-left: 100px; /* Leave space for the sidebar */
            padding: 20px;
            min-height: 40vh; /* Full height of the viewport */
            display: flex; /* Flexbox for alignment */
            flex-wrap: wrap; /* Allow wrapping of cards */
            gap: 20px; /* Gap between cards */
        }

        /* Card styles */
        .business-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            width: 250px;
            background-color: rgba(249, 249, 249, 0.9); /* Slight transparency */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Add shadow for depth */
            transition: transform 0.2s; /* Animation on hover */
        }

        .business-card:hover {
            transform: scale(1.05); /* Scale up on hover */
        }

        /* Button styles */
        .more-info-button, .toggle-form-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #3490dc;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s; /* Smooth transition */
        }
        
        .more-info-button:hover, .toggle-form-button:hover {
            background-color: #2779bd; /* Darker shade on hover */
        }

        /* Form styles */
        .form-container {
            display: none; /* Initially hidden */
            background-color: rgba(249, 249, 249, 0.9);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .submit-button {
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .submit-button:hover {
            background-color: #218838;
        }
        .minus-icon {
            display: block;
            width: 30px;
            height: 30px;
            background-color: #dc3545; /* Red background for the minus icon */
            color: white;
            border-radius: 50%; /* Make it circular */
            text-align: center;
            line-height: 30px; /* Center the text vertically */
            font-size: 20px; /* Icon size */
            position: absolute; /* Position it in the card */
            top: 10px; /* Adjust as needed */
            right: 10px; /* Adjust as needed */
            cursor: pointer;
        }
    </style>

    <!-- Plus Icon Button -->
    <button class="toggle-form-button" onclick="toggleForm()">+</button>

    <!-- Business Registration Form -->
    <div class="form-container" id="business-form">
        <h2>Register a New Business</h2>
        <form action="{{ route('business.store') }}" method="POST">
            @csrf
            <input type="text" name="business_name" placeholder="Business Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="address" placeholder="Address" required>
            <input type="text" name="phone_number" placeholder="Phone Number" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="submit-button">Register Business</button>
        </form>
    </div>

    <!-- Main Content -->
    <div class="content">
        @if(count($businesses) > 0)
            @foreach($businesses as $business)
                <div class="business-card">
                    <span class="minus-icon" onclick="confirmDelete({{ $business->id }})">-</span>
                    <h3 style="font-size: 1.25rem; font-weight: bold;">{{ $business->business_name }}</h3>
                    <button class="more-info-button" onclick="toggleInfo({{ $business->id }})">More Info</button>
                    <div id="info-{{ $business->id }}" style="display: none; margin-top: 10px;">
                        <p><strong>Email:</strong> {{ $business->email }}</p>
                        <p><strong>Address:</strong> {{ $business->address }}</p>
                        <p><strong>Phone:</strong> {{ $business->phone_number }}</p>
                        <p><strong>Username:</strong> {{ $business->username }}</p>
                    </div>
                </div>
            @endforeach
        @else
            <p>No businesses found.</p>
        @endif
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('business-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }

        function toggleInfo(id) {
            const info = document.getElementById('info-' + id);
            info.style.display = info.style.display === 'none' ? 'block' : 'none';
        }

        function confirmDelete(id) {
            if (confirm("Are you sure you want to delete this business?")) {
                deleteBusiness(id);
            }
        }

        function deleteBusiness(id) {
            fetch(`/businesses/delete/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include CSRF token for security
                    'Content-Type': 'application/json',
                },
            })
            .then(response => {
                if (response.ok) {
                    location.reload(); // Reload the page to reflect changes
                } else {
                    alert('Failed to delete the business.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while trying to delete the business.');
            });
        }
    </script>
@endsection
