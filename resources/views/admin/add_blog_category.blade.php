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
                    Add Blog Category
                </header>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" id="categoryForm" action="{{ URL::to('/save-category-blog') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="blog_category_name">Blog Category Name</label>
                                <input type="text" name="blog_category_name" class="form-control" id="blog_category_name"
                                    placeholder="blog category name">
                                @error('blog_category_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Blog Category Description</label>
                                <textarea class="form-control" name="blog_category_desc" id="blog_category_desc" placeholder="blog category desc"
                                    style="resize:none" rows="8"></textarea>
                                @error('blog_category_desc')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Blog Category Keyword</label>
                                <textarea class="form-control" name="category_blog_keywords" id="category_blog_keywords"
                                    placeholder="category blog keywords" style="resize:none" rows="8"></textarea>
                                @error('category_blog_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="blog_category_status">Visibility</label>
                                <select name="blog_category_status" class="form-control input-sm m-bot15">
                                    <option value="0" {{ old('blog_category_status') == 0 ? 'selected' : '' }}>Hide
                                    </option>
                                    <option value="1" {{ old('blog_category_status') == 1 ? 'selected' : '' }}>Show
                                    </option>
                                </select>
                            </div>
                            <button type="submit" name="add_blog_category" class="btn btn-info">Add Blog Category</button>
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
                    "blog_category_name": {
                        required: true,
                        maxlength: 50
                    },
                    "blog_category_desc": {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    "blog_category_name": {
                        required: "Bắt buộc nhập tên danh mục bài viết",
                        maxlength: "Tên danh mục bài viết không được vượt quá 50 ký tự"
                    },
                    "blog_category_desc": {
                        required: "Bắt buộc nhập mô tả danh mục bài viết",
                        minlength: "Mô tả danh mục bài viết ít nhất phải có 10 ký tự"
                    }
                }
            });
        });
    </script>
@endsection
