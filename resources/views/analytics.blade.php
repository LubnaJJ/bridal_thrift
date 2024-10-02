@extends('layouts.basic')

@section('content')
    <div style="display: flex; min-height: 100vh; margin: 0; padding: 0;">

        <!-- Main Content Area -->
        <div style="flex-grow: 1; background-image: url('/images/banner.jpg'); background-size: cover; background-position: center; padding: 50px; margin: 0; margin-top: -20px; margin-left: -10px; margin-right: -30px;">
            <h2 style="color: #ffffff; font-size: 25px;">Analytics</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
                <!-- Updated Businesses Overview Chart -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Businesses Overview</h3>
                    <canvas id="businessOverviewChart"></canvas>
                </div>

                <!-- Products by Business Chart -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Products by Business</h3>
                    <canvas id="productsByBusinessChart"></canvas>
                </div>

                <!-- Customers Count Chart -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Customers</h3>
                    <canvas id="customersCountChart"></canvas>
                </div>

                <!-- Total Products Listed Chart -->
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Products Listed</h3>
                    <canvas id="totalProductsChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Updated Businesses Overview Chart
        const businessOverviewLabels = @json($businesses->pluck('name')); // Fetch business names
        const businessOverviewData = Array(businessOverviewLabels.length).fill(1); // All businesses have a count of 1

        const ctxOverview = document.getElementById('businessOverviewChart').getContext('2d');
        const businessOverviewChart = new Chart(ctxOverview, {
            type: 'bar',
            data: {
                labels: businessOverviewLabels,
                datasets: [{
                    label: 'Number of Businesses',
                    data: businessOverviewData,
                    backgroundColor: '#FF6384',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return `${businessOverviewLabels[tooltipItem.dataIndex]}: 1`;
                            }
                        }
                    }
                }
            }
        });

        // Products by Business Chart
        const productsByBusinessLabels = @json($productsByBusiness->pluck('business.business_name')); // Business names
        const productsByBusinessData = @json($productsByBusiness->pluck('total')); // Number of products per business

        const ctxProducts = document.getElementById('productsByBusinessChart').getContext('2d');
        const productsByBusinessChart = new Chart(ctxProducts, {
            type: 'bar',
            data: {
                labels: productsByBusinessLabels,
                datasets: [{
                    label: 'Products Count',
                    data: productsByBusinessData,
                    backgroundColor: '#36A2EB',
                }]
            },
        });

        // Total Customers Chart
        const customerCount = {{ $customerCount }}; // Total number of customers
        const ctxCustomers = document.getElementById('customersCountChart').getContext('2d');
        const customersCountChart = new Chart(ctxCustomers, {
            type: 'bar',
            data: {
                labels: ['Total Customers'],
                datasets: [{
                    data: [customerCount],
                    backgroundColor: '#FFCE56',
                }]
            },
        });

        // Total Products Listed Chart
        const totalProductsCount = {{ $totalProducts }}; // Total number of products listed
        const ctxTotalProducts = document.getElementById('totalProductsChart').getContext('2d');
        const totalProductsChart = new Chart(ctxTotalProducts, {
            type: 'bar',
            data: {
                labels: ['Total Products Listed'],
                datasets: [{
                    data: [totalProductsCount],
                    backgroundColor: '#4BC0C0',
                }]
            },
        });
    </script>
@endsection
