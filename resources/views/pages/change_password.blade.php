@extends('collection')

@section('header')
    <title>Change Password</title>
@endsection

@section('product_content')
    <div class="my-4">
        <h2>Thiết lập mật khẩu mới</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form action="{{ route('update_password', $customer->customer_id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="new_password">Mật khẩu mới:</label>
                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="*****" required>
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">Nhập lại mật khẩu mới:</label>
                <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" placeholder="*****" required>
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Cập nhật mật khẩu</button>
        </form>
    </div>
@endsection
