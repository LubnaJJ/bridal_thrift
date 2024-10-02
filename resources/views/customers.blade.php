@extends('layouts.basic')

@section('navbar')
    <div class="navbar">
        <h2>Admin Menu</h2>
        <a href="{{ url('/customers') }}">View Customers</a>
        <a href="{{ url('/businesses') }}">View Businesses</a>
        <a href="{{ url('/logout') }}">Logout</a>
    </div>
@endsection

@section('content')
    <style>
        /* Existing styles */
        html, body {
            height: 100%;
            margin: 0;
            background-image: url('/images/banner.jpg');
            background-size: cover;
            background-position: center;
        }

        .content {
            margin-left: 0px;
            padding: 20px;
            min-height: 40vh;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            width: calc(100% - 250px);
        }

        .customer-card {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            width: 250px;
            background-color: rgba(249, 249, 249, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.2s;
            position: relative; /* Add this to position the minus icon */
        }

        .customer-card:hover {
            transform: scale(1.05);
        }

        .more-info-button {
            margin-top: 10px;
            padding: 5px 10px;
            background-color: #3490dc;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .more-info-button:hover {
            background-color: #2779bd;
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

        /* Plus icon and form styles */
        .plus-icon {
            display: block;
            width: 30px;
            height: 30px;
            margin: 20px auto; /* Center the icon */
            cursor: pointer;
            background-color: #3490dc; /* Background color for the icon */
            color: white;
            border-radius: 50%; /* Make it circular */
            text-align: center;
            line-height: 30px; /* Center the text vertically */
            font-size: 20px; /* Icon size */
        }

        .customer-form {
            display: none; /* Hide form initially */
            margin-top: 10px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .customer-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .customer-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Ensure padding is included in width */
        }

        .customer-form button {
            padding: 10px;
            background-color: #28a745; /* Green background */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%; /* Make buttons take up almost half of the container */
            font-size: 16px; /* Make button text larger */
        }

        .customer-form button:hover {
            background-color: #218838; /* Darker green on hover */
        }

        .button-container {
            display: flex;
            justify-content: space-between; /* Space between buttons */
            margin-top: 10px; /* Space above buttons */
        }
    </style>

    <div class="content">
        @if(count($customers) > 0)
            @foreach($customers as $customer)
                <div class="customer-card">
                    <span class="minus-icon" onclick="confirmDelete({{ $customer->id }})">-</span>
                    <h3 style="font-size: 1.25rem; font-weight: bold;">{{ $customer->name }}</h3>
                    <button class="more-info-button" onclick="toggleInfo({{ $customer->id }})">More Info</button>
                    <div id="info-{{ $customer->id }}" style="display: none; margin-top: 10px;">
                        <p><strong>Username:</strong> {{ $customer->username }}</p>
                        <p><strong>Email:</strong> {{ $customer->email }}</p>
                        <p><strong>Phone:</strong> {{ $customer->number }}</p>
                        <p><strong>Address:</strong> {{ $customer->address }}</p>
                        <p><strong>Age:</strong> {{ $customer->age }}</p>
                        <button class="more-info-button" onclick="toggleUpdateForm({{ $customer->id }})">Update</button>
                        <!-- Update Form -->
                        <div id="update-form-{{ $customer->id }}" class="customer-form" style="display: none;">
                            <form action="{{ route('update.customer', $customer->id) }}" method="POST">
                                @csrf
                                <div>
                                    <label for="name">Name:</label>
                                    <input type="text" name="name" value="{{ $customer->name }}" required>
                                </div>
                                <div>
                                    <label for="username">Username:</label>
                                    <input type="text" name="username" value="{{ $customer->username }}" required>
                                </div>
                                <div>
                                    <label for="email">Email:</label>
                                    <input type="email" name="email" value="{{ $customer->email }}" required>
                                </div>
                                <div>
                                    <label for="number">Phone:</label>
                                    <input type="text" name="number" value="{{ $customer->number }}" required>
                                </div>
                                <div>
                                    <label for="address">Address:</label>
                                    <input type="text" name="address" value="{{ $customer->address }}" required>
                                </div>
                                <div>
                                    <label for="age">Age:</label>
                                    <input type="number" name="age" value="{{ $customer->age }}" required>
                                </div>
                                <div class="button-container">
                                    <button type="submit">Save</button>
                                    <button type="button" onclick="toggleUpdateForm({{ $customer->id }})">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No customers found.</p>
        @endif
    </div>

    <!-- Plus icon for adding a new customer -->
    <div class="plus-icon" onclick="toggleForm()">+</div>

    <!-- Customer creation form -->
    <div id="new-customer-form" class="customer-form">
        <form action="{{ route('add.customer.store') }}" method="POST">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" required>
            </div>
            <div>
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
            </div>
            <div>
                <label for="number">Phone:</label>
                <input type="text" name="number" required>
            </div>
            <div>
                <label for="address">Address:</label>
                <input type="text" name="address" required>
            </div>
            <div>
                <label for="age">Age:</label>
                <input type="number" name="age" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

    <script>
        function toggleInfo(id) {
            const info = document.getElementById('info-' + id);
            info.style.display = info.style.display === 'none' ? 'block' : 'none';
        }

        function toggleForm() {
            const form = document.getElementById('new-customer-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function toggleUpdateForm(id) {
            const form = document.getElementById('update-form-' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }

        function confirmDelete(id) {
            if (confirm('Are you sure you want to delete this customer?')) {
                // Redirect or AJAX call to delete the customer
                window.location.href = "{{ url('/delete/customer/') }}/" + id;
            }
        }
    </script>
@endsection
