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
                Tạo mã giảm giá hàng loạt
            </header>
            <div class="panel-body">
                <div class="position-center">
                    <form role="form" id="batchCouponForm" action="{{ route('store-batch-coupon') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="coupon_name">Tên mã giảm giá</label>
                            <input type="text" name="coupon_name" class="form-control" id="coupon_name" placeholder="Tên mã giảm giá">
                        </div>
                        <div class="form-group">
                            <label for="coupon_expire_date">Ngày hết hạn mã giảm giá</label>
                            <input type="date" class="form-control" name="coupon_expire_date" id="coupon_expire_date">
                        </div>
                        <div class="form-group">
                            <label for="coupon_condition">Tính năng mã giảm giá</label>
                            <select name="coupon_condition" class="form-control">
                                <option value="1">Giảm theo phần trăm</option>
                                <option value="2">Giảm theo số tiền</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="coupon_number">Nhập số %/ số tiền giảm</label>
                            <input type="text" class="form-control" name="coupon_number" id="coupon_number">
                        </div>
                        <div class="form-group">
                            <label for="coupon_quantity">Số lượng mã giảm giá</label>
                            <input type="text" class="form-control" name="coupon_quantity" id="coupon_quantity">
                        </div>
                        <button type="submit" class="btn btn-info">Tạo mã giảm giá hàng loạt</button>
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
