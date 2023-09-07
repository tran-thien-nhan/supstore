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
                    Add Product Category
                </header>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" id="categoryForm" action="{{ URL::to('/save-category-product') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="category_product_name">Category Name</label>
                                <input type="text" name="category_product_name" class="form-control"
                                    id="category_product_name" placeholder="tên danh mục">
                                @error('category_product_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category Description</label>
                                <textarea class="form-control" name="category_product_desc" id="category_product_desc" placeholder="mô tả danh mục"
                                    style="resize:none" rows="8"></textarea>
                                @error('category_product_desc')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Category Keyworkds</label>
                                <textarea class="form-control" name="category_product_keywords" id="category_product_keywords"
                                    placeholder="từ khóa mô tả danh mục" style="resize:none" rows="8"></textarea>
                                @error('category_product_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category_product_status">Visibility</label>
                                <select name="category_product_status" class="form-control input-sm m-bot15">
                                    <option value="0" {{ old('category_product_status') == 0 ? 'selected' : '' }}>Hide
                                    </option>
                                    <option value="1" {{ old('category_product_status') == 1 ? 'selected' : '' }}>Show
                                    </option>
                                </select>
                            </div>
                            <button type="submit" name="add_category_product" class="btn btn-info">Add Product Category</button>
                        </form>
                    </div>

                </div>
            </section>

        </div>
    </div>
    <script>
        $(document).ready(function() {
            $("#categoryForm").validate({
                onfocusout: false,
                onkeyup: false,
                onclick: false,
                rules: {
                    "category_product_name": {
                        required: true,
                        maxlength: 50
                    },
                    "category_product_desc": {
                        required: true,
                        minlength: 50
                    }
                },
                messages: {
                    "category_product_name": {
                        required: "Bắt buộc nhập tên danh mục",
                        maxlength: "Tên danh mục không được vượt quá 50 ký tự"
                    },
                    "category_product_desc": {
                        required: "Bắt buộc nhập mô tả danh mục",
                        minlength: "Mô tả danh mục ít nhất phải có 50 ký tự"
                    }
                }
            });
        });
    </script>
@endsection
