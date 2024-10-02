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
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #e2e8f0;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #3490dc;
            color: white;
        }

        td {
            background-color: rgba(249, 249, 249, 0.9);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .edit-button, .delete-button {
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }

        .edit-button {
            background-color: #28a745;
        }

        .delete-button {
            background-color: #dc3545;
        }

        .delete-button:hover {
            background-color: #c82333;
        }

        .edit-button:hover {
            background-color: #218838;
        }

        .plus-icon {
            display: block;
            width: 30px;
            height: 30px;
            margin: 20px auto;
            cursor: pointer;
            background-color: #3490dc;
            color: white;
            border-radius: 50%;
            text-align: center;
            line-height: 30px;
            font-size: 20px;
        }

        .customer-form {
            display: none;
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
            box-sizing: border-box;
        }

        .customer-form button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
            font-size: 16px;
        }

        .customer-form button:hover {
            background-color: #218838;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>

    <div class="content">
        <h1>Customers List</h1>

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->username }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->number }}</td>
                        <td>{{ $customer->address }}</td>
                        <td>{{ $customer->age }}</td>
                        <td class="action-buttons">
                            <button class="edit-button" onclick="toggleUpdateForm({{ $customer->id }})">Edit</button>

                            <!-- Delete button -->
                            <form action="{{ route('customers.delete', $customer->id) }}" method="POST" onsubmit="return confirmDelete({{ $customer->id }})">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Plus icon for adding a new customer -->
        <div class="plus-icon" onclick="toggleForm()">+</div>

        <!-- Customer creation form -->
        <div id="new-customer-form" class="customer-form">
            <h2>Add New Customer</h2>
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

        <!-- Update customer form -->
        @foreach($customers as $customer)
            <div id="update-form-{{ $customer->id }}" class="customer-form" style="display: none;">
                <h2>Edit Customer: {{ $customer->name }}</h2>
                <form action="{{ route('update.customer', $customer->id) }}" method="POST">

                    @csrf
                    @method('PUT')
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
        @endforeach
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('new-customer-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }

        function toggleUpdateForm(id) {
            const form = document.getElementById(`update-form-${id}`);
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }

        function confirmDelete(id) {
            return confirm('Are you sure you want to delete this customer?');
        }
    </script>
@endsection
