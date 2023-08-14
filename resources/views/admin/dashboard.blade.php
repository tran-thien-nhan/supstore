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
                                <span class="badge bg-success text-white" style="font-size: 1rem; color:white"><span
                                        class="text-warning"> &#9733;
                                    </span>{{ $mostPurchasedProduct->product_name }}</span>
                                <br><br>
                                <p>Tổng Doanh Số Giao Hàng
                                    Thành Công Trong Tháng {{$currentMonth}}: <span class="badge bg-success text-white"
                                        style="font-size: 1rem; color: white">{{ number_format($totalRevenueCurrentMonth) }}</span>
                                </p>
                            @else
                                <p>Chưa có thông tin về sản phẩm</p>
                            @endif
                        </div>
                    </div>
                </div>
                <canvas id="revenueChart"></canvas>
            </div>
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
    </script>
@endsection

<style>
    .chart-container {
        background-color: white;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
</style>
