@extends('admin_layout')
@section('admin_content')
    <div class="row justify-content-center align-items-center" style="height: 100vh;">
        <div class="col-lg-8">
            <div class="chart-container">
                <h3 class="text-center">DAILY REVENUE</h3>
                <div class="row justify-content-center align-items-center" style="margin-top: 20px;">
                    <div class="col-lg-8">
                        <div class="info-container">
                            @if ($mostPurchasedProduct)
                                <p>Total Order Revenue
                                    Shipped Successfully In Month {{ $currentMonth }}: <span class="badge bg-success text-white"
                                        style="font-size: 1rem; color: white">{{ number_format($totalRevenueCurrentMonth) }}</span>
                                </p>
                            @else
                                <p>Not Yet</p>
                            @endif
                        </div>
                    </div>
                </div>
                <canvas id="revenueChart"></canvas>
                <hr>
                <h3 class="text-center">MONTHLY REGISTRATION RATE IN {{ $currentYear }}</h3>
                <canvas id="registrationsChart"></canvas>
                <hr>
                <h3 class="text-center">MONTHLY REVENUE IN {{ $currentYear }}</h3>
                <canvas id="monthlyRevenueChart"></canvas>
            </div>
        </div>
        <div class="top-customers col-lg-4">
            <h3 class="text-center">TOP 3 CUSTOMERS</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th style="color:blue">Customer Name</th>
                        <th style="color:blue">Points</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topCustomers as $customer)
                        <tr>
                            <td style="font-weight:bold; color: black">{{ $customer->customer_name }}</td>
                            <td><span class="badge bg-danger" style="font-size: 1rem">{{ $customer->customer_point }}</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="top-products col-lg-4">
            <h3 class="text-center">TOP 5 PRODUCTS SOLD</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th style="color:blue">Product Name</th>
                        <th style="color:blue">Quantity Sold</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topProducts as $product)
                        <tr>
                            <td style="font-weight:bold; color: black">{{ $product->product_name }}</td>
                            <td><span class="badge bg-success"
                                    style="font-size: 1rem;color:white">{{ 100 - $product->product_quantity }} sold</span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="customer-registrations col-lg-4">
            <h3 class="text-center">CUSTOMER REGISTRATIONS</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th style="color:blue">Month</th>
                        <th style="color:blue">Registrations</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customerRegistrations as $registration)
                        <tr>
                            <td style="font-weight:bold; color: black">{{ $registration->year }}-{{ str_pad($registration->month, 2, '0', STR_PAD_LEFT) }}</td>
                            <td style="font-weight:bold; color: black">{{ $registration->registrations }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var dates = @json($dailyRevenue->pluck('date'));
        var revenue = @json($dailyRevenue->pluck('total'));

        var ctx = document.getElementById('revenueChart').getContext('2d');
        var chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Daily Revenue',
                    data: revenue,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var customerRegistrationLabels = @json($customerRegistrationLabels);
        var customerRegistrationData = @json($customerRegistrationData);

        var registrationsCtx = document.getElementById('registrationsChart').getContext('2d');
        var registrationsChart = new Chart(registrationsCtx, {
            type: 'line',
            data: {
                labels: customerRegistrationLabels,
                datasets: [{
                    label: 'Customer Registrations',
                    data: customerRegistrationData,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var monthlyLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
        ]; // Tên các tháng
        var monthlyData = @json($monthlyData);

        var monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        var monthlyRevenueChart = new Chart(monthlyRevenueCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: monthlyData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        var monthlyLabels = ["January", "February", "March", "April", "May", "June", "July", "August", "September",
            "October", "November", "December"
        ];
        var monthlyData = @json($monthlyRevenue->pluck('total'));

        var monthlyRevenueCtx = document.getElementById('monthlyRevenueChart').getContext('2d');
        var monthlyRevenueChart = new Chart(monthlyRevenueCtx, {
            type: 'bar',
            data: {
                labels: monthlyLabels,
                datasets: [{
                    label: 'Monthly Revenue',
                    data: monthlyData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection

<style>
    .chart-container {
        background-color: white;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-bottom: 20px;
    }

    .top-customers {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
        /* Màu nền trắng */
    }

    .top-customers ul {
        list-style: none;
        padding-left: 0;
    }

    .top-customers li {
        margin-bottom: 5px;
    }

    .top-customers h3 {
        color: black;
        /* Màu chữ đen */
    }

    .table th,
    .table td {
        color: black;
        /* Màu chữ đen cho các ô trong bảng */
    }

    .top-products {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
    }

    .top-products h3 {
        color: black;
    }

    .table th,
    .table td {
        color: black;
    }

    .customer-registrations {
        margin-top: 20px;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        background-color: white;
        /* Màu nền trắng */
    }

    .customer-registrations h3 {
        color: black;
        /* Màu chữ đen */
    }
</style>
