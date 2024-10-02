<!-- resources/views/businesses.blade.php -->
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

        .business-form {
            display: none;
            margin-top: 10px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .business-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .business-form input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .business-form button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 48%;
            font-size: 16px;
        }

        .business-form button:hover {
            background-color: #218838;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
        }
    </style>

    <div class="content">
        <h1>Businesses List</h1>

        <table>
            <thead>
                <tr>
                    <th>Business Name</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($businesses as $business)
                    <tr>
                        <td>{{ $business->business_name }}</td>
                        <td>{{ $business->email }}</td>
                        <td>{{ $business->address }}</td>
                        <td>{{ $business->phone_number }}</td>
                        <td>{{ $business->username }}</td>
                        <td class="action-buttons">
                            <button class="edit-button" onclick="openEditModal({{ json_encode($business) }})">Edit</button>

                            <!-- Delete button -->
                            <form action="{{ route('business.destroy', $business->id) }}" method="POST" onsubmit="return confirmDelete({{ $business->id }})">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-button">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Plus icon for adding a new business -->
        <div class="plus-icon" onclick="toggleAddModal()">+</div>

        <!-- Business creation form -->
        <div id="new-business-form" class="business-form">
            <h2>Add New Business</h2>
            <form action="{{ route('business.store') }}" method="POST">
                @csrf
                <div>
                    <label for="business_name">Business Name:</label>
                    <input type="text" name="business_name" required>
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" name="email" required>
                </div>
                <div>
                    <label for="address">Address:</label>
                    <input type="text" name="address" required>
                </div>
                <div>
                    <label for="phone_number">Phone:</label>
                    <input type="text" name="phone_number" required>
                </div>
                <div>
                    <label for="username">Username:</label>
                    <input type="text" name="username" required>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>

        <!-- Edit Modal -->
        <div id="editModal" class="business-form">
            <h2>Edit Business</h2>
            <form id="editForm" action="{{ route('business.update', '') }}" method="POST">
                @csrf
                <input type="hidden" id="businessId" name="id">
                <div class="form-group">
                    <label for="edit_business_name">Business Name</label>
                    <input type="text" id="edit_business_name" name="business_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_email">Email</label>
                    <input type="email" id="edit_email" name="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_address">Address</label>
                    <input type="text" id="edit_address" name="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_phone_number">Phone Number</label>
                    <input type="text" id="edit_phone_number" name="phone_number" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="edit_username">Username</label>
                    <input type="text" id="edit_username" name="username" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </div>

    <script>
        function openEditModal(business) {
            document.getElementById('editModal').style.display = 'block';
            document.getElementById('businessId').value = business.id;
            document.getElementById('edit_business_name').value = business.business_name;
            document.getElementById('edit_email').value = business.email;
            document.getElementById('edit_address').value = business.address;
            document.getElementById('edit_phone_number').value = business.phone_number;
            document.getElementById('edit_username').value = business.username;
        }

        function closeModal() {
            document.getElementById('editModal').style.display = 'none';
        }

        function toggleAddModal() {
            const form = document.getElementById('new-business-form');
            form.style.display = form.style.display === 'none' || form.style.display === '' ? 'block' : 'none';
        }

        function confirmDelete(id) {
            return confirm('Are you sure you want to delete this business?');
        }
    </script>
@endsection
