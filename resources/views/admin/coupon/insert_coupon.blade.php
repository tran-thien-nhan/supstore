@extends('admin_layout')
@section('admin_content')
    <style>
        label.error {
            color: red;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    ADD COUPON
                </header>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" id="couponForm" action="{{ URL::to('/insert-coupon-code') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="coupon_name">Coupon Name</label>
                                <input type="text" name="coupon_name" class="form-control" id="coupon_name"
                                    placeholder="Coupon Name">
                                @error('coupon_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Coupon Code</label>
                                <input type="text" class="form-control" name="coupon_code" id="coupon_code"
                                    placeholder="Coupon Code">
                                @error('coupon_code')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Coupon Quantity</label>
                                <input type="text" class="form-control" name="coupon_time" id="coupon_time"
                                    placeholder="Coupon Quantity">
                                @error('coupon_time')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Coupon Expired Date</label>
                                <input type="date" class="form-control" name="coupon_expire_date"
                                    id="coupon_expire_date">
                                @error('coupon_expire_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Coupon Feature</label>
                                <select name="coupon_condition" class="form-control input-sm m-bot15">
                                    <option value="1" {{ old('coupon_condition') == 1 ? 'selected' : '' }}>Discount By
                                        Percentage</option>
                                    <option value="2" {{ old('coupon_condition') == 2 ? 'selected' : '' }}>Discount By
                                        Amount</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Enter % / Amount to discount</label>
                                <input type="text" class="form-control" name="coupon_number" id="coupon_number">
                                @error('coupon_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="coupon_status">Visibility</label>
                                <select name="coupon_status" class="form-control input-sm m-bot15">
                                    <option value="0" {{ old('coupon_status') == 0 ? 'selected' : '' }}>Hide</option>
                                    <option value="1" {{ old('coupon_status') == 1 ? 'selected' : '' }}>Show
                                    </option>
                                </select>
                            </div>
                            <button type="submit" name="add_coupon" class="btn btn-info">Add Coupon</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#couponForm").validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "coupon_name": {
                        required: true,
                        maxlength: 50
                    },
                    "coupon_desc": {
                        required: true,
                        minlength: 50
                    }
                },
                messages: {
                    "coupon_name": {
                        required: "Bắt buộc nhập tên mã giảm giá",
                        maxlength: "Tên mã giảm giá không được vượt quá 50 ký tự"
                    },
                    "coupon_desc": {
                        required: "Bắt buộc nhập mô tả mã giảm giá",
                        minlength: "Mô tả mã giảm giá ít nhất phải có 50 ký tự"
                    }
                }
            });
        });
    </script>
@endsection
