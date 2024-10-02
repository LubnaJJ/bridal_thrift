@extends('layouts.basic')

@section('content')
    <div class="container mx-auto mt-10">
        <h2 class="text-2xl font-bold mb-5">Manage Businesses</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($businesses as $business)
                <div class="bg-white p-4 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">{{ $business->business_name }}</h3>
                    <p>Email: {{ $business->email }}</p>
                    <p>Phone: {{ $business->phone_number }}</p>
                    <button class="text-blue-500 update-btn" data-id="{{ $business->id }}">Update</button>
                    <button class="text-red-500 remove-btn" data-id="{{ $business->id }}">Remove</button>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Update Business Modal -->
    <div id="updateBusinessModal" style="display: none;">
        <div class="modal-content">
            <h3>Update Business</h3>
            <input type="text" id="updateBusinessName" placeholder="Business Name" />
            <input type="email" id="updateBusinessEmail" placeholder="Email" />
            <input type="text" id="updateBusinessPhone" placeholder="Phone Number" />
            <button id="saveBusinessUpdate">Save</button>
            <button id="cancelBusinessUpdate">Cancel</button>
        </div>
    </div>

    <!-- Confirmation Popup -->
    <div id="businessConfirmationPopup" style="display: none;">
        <p>Are you sure you want to delete this business?</p>
        <button id="confirmBusinessDelete">Yes</button>
        <button id="cancelBusinessDelete">No</button>
    </div>

    <script>
        let currentBusinessId;

        // Update button click event
        document.querySelectorAll('.update-btn').forEach(button => {
            button.addEventListener('click', function() {
                currentBusinessId = this.dataset.id;
                // Fetch business details (you may want to use AJAX here)
                document.getElementById('updateBusinessName').value = 'Business Name'; // Replace with fetched data
                document.getElementById('updateBusinessEmail').value = 'business@example.com'; // Replace with fetched data
                document.getElementById('updateBusinessPhone').value = '0987654321'; // Replace with fetched data
                document.getElementById('updateBusinessModal').style.display = 'block';
            });
        });

        // Save updated business details
        document.getElementById('saveBusinessUpdate').addEventListener('click', function() {
            const updatedBusiness = {
                id: currentBusinessId,
                name: document.getElementById('updateBusinessName').value,
                email: document.getElementById('updateBusinessEmail').value,
                phone_number: document.getElementById('updateBusinessPhone').value,
            };

            // Make AJAX call to update business in database
            console.log('Updated business:', updatedBusiness);
            document.getElementById('updateBusinessModal').style.display = 'none'; // Close modal
        });

        // Remove button click event
        document.querySelectorAll('.remove-btn').forEach(button => {
            button.addEventListener('click', function() {
                currentBusinessId = this.dataset.id;
                document.getElementById('businessConfirmationPopup').style.display = 'block';
            });
        });

        // Confirm deletion
        document.getElementById('confirmBusinessDelete').addEventListener('click', function() {
            // Make AJAX call to delete business from database
            console.log('Deleted business ID:', currentBusinessId);
            // Remove business card from UI
            document.getElementById('businessConfirmationPopup').style.display = 'none'; // Close popup
        });

        // Cancel update
        document.getElementById('cancelBusinessUpdate').addEventListener('click', function() {
            document.getElementById('updateBusinessModal').style.display = 'none'; // Close modal
        });

        // Cancel deletion
        document.getElementById('cancelBusinessDelete').addEventListener('click', function() {
            document.getElementById('businessConfirmationPopup').style.display = 'none'; // Close popup
        });
    </script>
@endsection
