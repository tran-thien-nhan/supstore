@extends('collection')

@section('header')
    <title>Information</title>
@endsection

@section('product_content')
    <div class="my-4">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td>{{ $customer->customer_name }}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td>{{ $customer->customer_email }}</td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td>{{ $customer->customer_phone }}</td>
                </tr>
                <tr>
                    <th>Point:</th>
                    <td>{{ number_format($customer->customer_point, 1) }}</td>
                </tr>
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
                <tr>
                    <th>Rank:</th>
                    <td><span class="{{ $rankColor }}" style="font-size:1rem">{{ $rank }}</span></td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
