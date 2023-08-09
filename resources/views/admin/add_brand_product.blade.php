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
                    Thêm thương hiệu sản phẩm
                </header>

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif

                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" id="brandForm" action="{{ URL::to('/save-brand-product') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="brand_product_name">Tên thương hiệu</label>
                                <input type="text" name="brand_product_name" class="form-control" id="brand_product_name"
                                    placeholder="Tên thương hiệu">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                <textarea class="form-control" name="brand_product_desc" id="brand_product_desc" placeholder="Mô tả thương hiệu"
                                    style="resize:none" rows="8"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="brand_product_status">Hiển thị</label>
                                <select name="brand_product_status" class="form-control input-sm m-bot15">
                                    <option value="0" {{ old('brand_product_status') == 0 ? 'selected' : '' }}>Ẩn
                                    </option>
                                    <option value="1" {{ old('brand_product_status') == 1 ? 'selected' : '' }}>Hiển thị
                                    </option>
                                </select>
                            </div>
                            <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#brandForm").validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "brand_product_name": {
                        required: true,
                        maxlength: 50
                    },
                    "brand_product_desc": {
                        required: true,
                        minlength: 5
                    }
                },
                messages: {
                    "brand_product_name": {
                        required: "Bắt buộc nhập tên thương hiệu",
                        maxlength: "Tên thương hiệu không được vượt quá 50 ký tự"
                    },
                    "brand_product_desc": {
                        required: "Bắt buộc nhập mô tả thương hiệu",
                        minlength: "Mô tả thương hiệu ít nhất phải có 5 ký tự"
                    }
                }
            });
        });
    </script>
@endsection
