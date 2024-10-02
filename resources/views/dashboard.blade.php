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

        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
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
            <!-- Display dynamic content from other views here -->
            @yield('content')

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

            <!-- List of Customers -->
            <div class="mt-10 w-full">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Customer List</h2>
                <table class="min-w-full bg-white rounded-lg shadow overflow-hidden">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 text-left text-gray-600">Name</th>
                            <th class="py-2 px-4 text-left text-gray-600">Username</th>
                            <th class="py-2 px-4 text-left text-gray-600">Email</th>
                            <th class="py-2 px-4 text-left text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                        <tr>
                            <td class="py-2 px-4">{{ $customer->name }}</td>
                            <td class="py-2 px-4">{{ $customer->username }}</td>
                            <td class="py-2 px-4">{{ $customer->email }}</td>
                            <td class="py-2 px-4">
                                <button onclick="openEditModal({{ $customer }})" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <h3 class="text-lg font-semibold mb-4">Edit Customer</h3>
            <form id="editForm" method="POST" action="">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700">Name</label>
                    <input type="text" id="editName" name="name" class="w-full border border-gray-300 px-4 py-2 rounded" required>
                </div>

                <!-- Username -->
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" id="editUsername" name="username" class="w-full border border-gray-300 px-4 py-2 rounded" required>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700">Email</label>
                    <input type="email" id="editEmail" name="email" class="w-full border border-gray-300 px-4 py-2 rounded" required>
                </div>

                <!-- Submit and Cancel -->
                <div class="flex justify-between">
                    <button type="button" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600" onclick="closeEditModal()">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Open the edit modal and populate the form with customer data
        function openEditModal(customer) {
            document.getElementById('editForm').action = `/customers/${customer.id}`;
            document.getElementById('editName').value = customer.name;
            document.getElementById('editUsername').value = customer.username;
            document.getElementById('editEmail').value = customer.email;
            document.getElementById('editModal').style.display = 'flex';
        }

        // Close the edit modal
        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</body>
</html>
