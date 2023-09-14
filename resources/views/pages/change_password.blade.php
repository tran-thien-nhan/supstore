@extends('collection')

@section('header')
    <title>Change Password</title>
@endsection

@section('product_content')
    <div class="my-4">
        <h2>Change Password</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('update_password', $customer->customer_id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="*****" required>
                @error('new_password')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Enter new password:</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"
                    placeholder="*****" required>
                @error('new_password_confirmation')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Update Password</button>
        </form>
    </div>
@endsection
