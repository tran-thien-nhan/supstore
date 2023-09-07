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
                    Created a batch of coupons
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" id="batchCouponForm" action="{{ route('store-batch-coupon') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="coupon_name">Coupon Name</label>
                                <input type="text" name="coupon_name" class="form-control" id="coupon_name"
                                    placeholder="Tên mã giảm giá">
                                @error('coupon_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="coupon_expire_date">Coupon Expired date</label>
                                <input type="date" class="form-control" name="coupon_expire_date"
                                    id="coupon_expire_date">
                                @error('coupon_expire_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="coupon_condition">Coupon feature</label>
                                <select name="coupon_condition" class="form-control">
                                    <option value="1">Discount By Percentage</option>
                                    <option value="2">Discount By Amount Of Money</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="coupon_number">Enter %/ Amount to discount</label>
                                <input type="text" class="form-control" name="coupon_number" id="coupon_number">
                                @error('coupon_number')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="coupon_quantity">Number of coupons</label>
                                <input type="text" class="form-control" name="coupon_quantity" id="coupon_quantity">
                                @error('coupon_quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-info">Create them !</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#batchCouponForm").validate({
                rules: {
                    coupon_name: {
                        required: true,
                        maxlength: 50
                    },
                    coupon_expire_date: {
                        required: true,
                        date: true
                    },
                    coupon_number: {
                        required: true,
                        digits: true
                    },
                    coupon_quantity: {
                        required: true,
                        digits: true
                    }
                },
                messages: {
                    coupon_name: {
                        required: "Vui lòng nhập tên mã giảm giá",
                        maxlength: "Tên mã giảm giá không được quá 50 ký tự"
                    },
                    coupon_expire_date: {
                        required: "Vui lòng chọn ngày hết hạn",
                        date: "Vui lòng nhập ngày hợp lệ"
                    },
                    coupon_number: {
                        required: "Vui lòng nhập số %/ số tiền giảm",
                        digits: "Vui lòng nhập số nguyên dương"
                    },
                    coupon_quantity: {
                        required: "Vui lòng nhập số lượng mã giảm giá",
                        digits: "Vui lòng nhập số nguyên dương"
                    }
                }
            });
        });
    </script>
@endsection
