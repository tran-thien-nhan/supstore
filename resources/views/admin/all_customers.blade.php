@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    customerS LIST
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <a href="{{ route('composeEmailCustomer') }}" class="btn btn-primary">Compose Email</a>
                </div>
                <div class="row" style="display: flex; margin-left:0.5rem">
                    <div class="panel-body">
                        <form id="filter-form" method="GET" action="{{ route('filterCustomersByRank') }}">
                            @csrf
                            <div class="form-group">
                                <label for="rank">Filter by Rank:</label>
                                <select name="rank" id="rank" class="form" onchange="submitForm()">
                                    <option value="">Select Rank</option>
                                    <option value="all">All</option>
                                    <option value="Diamond">Diamond</option>
                                    <option value="Silver">Silver</option>
                                    <option value="Gold">Gold</option>
                                    <option value="Newbie">Newbie</option>
                                </select>
                            </div>
                        </form>
                    </div>
    
                    <div class="panel-body">
                        <form id="filter-form-district" method="GET" action="{{ route('filterCustomersByDistrict') }}">
                            @csrf
                            <div class="form-group">
                                <label for="district">Filter by District:</label>
                                <select name="district" id="district" class="form" onchange="submitForm1()">
                                    <option value="">Select District</option>
                                    <option value="all" {{ request('district') == 'all' ? 'selected' : '' }}>All</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->district_id }}"
                                            {{ $district->district_id == request('district') ? 'selected' : '' }}>
                                            {{ $district->district_name }}
                                        </option>
                                    @endforeach
                                </select>
    
                            </div>
                        </form>
                    </div>
    
                    <div class="panel-body">
                        <form id="search-form" method="GET" action="{{ route('searchCustomers') }}">
                            @csrf
                            <div class="form-group">
                                <label for="search">Search:</label>
                                <input type="text" name="search" id="search" class="form"
                                    placeholder="Search by name, email, or phone" value="{{ request('search') }}">
                            </div>
                        </form>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>District</th>
                                <th>Point</th>
                                <th>rank</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customers as $key => $customer)
                                <tr>
                                    <td>{{ $customer->customer_id }}</td>
                                    <td>{{ $customer->customer_name }}</td>
                                    <td>{{ $customer->customer_email }}</td>
                                    <td>{{ $customer->customer_phone }}</td>
                                    <td>
                                        @if ($customer->customer_address)
                                            {{ $customer->customer_address }}
                                        @else
                                            @if ($customer->district)
                                                {{ $customer->district->district_name }}
                                            @else
                                                Unknown
                                            @endif
                                        @endif
                                    </td>

                                    <td>{{ $customer->district->district_name }}</td>
                                    <td>{{ $customer->customer_point }}</td>
                                    <td>
                                        @php
                                            if ($customer->customer_point >= 1500) {
                                                $rank = 'Diamond';
                                                $rankColor = 'badge bg-danger';
                                            } elseif ($customer->customer_point >= 1000) {
                                                $rank = 'Silver';
                                                $rankColor = 'badge bg-primary';
                                            } elseif ($customer->customer_point >= 500) {
                                                $rank = 'Gold';
                                                $rankColor = 'badge bg-warning';
                                            } else {
                                                $rank = 'Newbie';
                                                $rankColor = 'badge bg-dark';
                                            }
                                        @endphp
                                        <span class="{{ $rankColor }}">{{ $rank }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $customers->links() }}
            </div>
        </div>
    </div>
    <script>
        function submitForm() {
            document.getElementById('filter-form').submit();
        }

        function submitForm1() {
            document.getElementById('filter-form-district').submit();
        }
    </script>
@endsection
