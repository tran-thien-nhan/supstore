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
                    <th>Address:</th>
                    <td>{{ $customer->customer_address }}</td>
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
        <!-- Button to trigger the modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal">
            Update Information
        </button>

        <!-- Modal for updating customer information -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Customer Information</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('update_customer', $customer->customer_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="customer_name">Name:</label>
                                <input type="text" class="form-control" id="customer_name" name="customer_name"
                                    value="{{ $customer->customer_name }}">
                                @error('customer_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="customer_email">Email:</label>
                                <input type="email" class="form-control" id="customer_email" name="customer_email"
                                    value="{{ $customer->customer_email }}">
                                @error('customer_email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="customer_phone">Phone:</label>
                                <input type="tel" class="form-control" id="customer_phone" name="customer_phone"
                                    value="{{ $customer->customer_phone }}">
                                @error('customer_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="customer_address">Address:</label>
                                <textarea class="form-control" id="customer_address" name="customer_address">{{ old('customer_address', $customer->customer_address) }}</textarea>
                                @error('customer_address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('change_password') }}">thiết lập mật khẩu</a>
@endsection
