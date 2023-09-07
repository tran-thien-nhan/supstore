@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Product Category
                </header>
                <?php
                // $message = Session::get('message');
                // if ($message) {
                //     echo '<span style="color: red; text-align: center; font-size: 17px; width: 100%; font-weight: bold">' . $message . '</span>';
                //     Session::put('message', null);
                // }
                ?>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    @foreach ($edit_category_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{ URL::to('/update-category-product/' . $edit_value->category_id) }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="category_product_name">Category Name</label>
                                    <input type="text" value="{{ $edit_value->category_name }}"
                                        name="category_product_name" class="form-control" id="category_product_name"
                                        placeholder="tên danh mục">
                                    @error('category_product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_product_desc">Category Description</label>
                                    <textarea class="form-control" name="category_product_desc" id="category_product_desc" placeholder="mô tả danh mục"
                                        style="resize:none" rows="8">{{ $edit_value->category_desc }}</textarea>
                                    @error('category_product_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Category Keywords</label>
                                    <textarea class="form-control" name="category_product_keywords" id="category_product_keywords"
                                        placeholder="từ khóa mô tả danh mục" style="resize:none" rows="8">{{ $edit_value->meta_keywords }}</textarea>
                                    @error('category_product_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" name="update_category_product" class="btn btn-info">Update Category</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
@endsection
