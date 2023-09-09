@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    UPDATE Blog Category
                </header>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($edit_category_blog as $edit_value)
                            <form role="form" method="POST" action="{{ route('update-category-blog', $edit_value->blog_category_id) }}">
                                @csrf
                                <div class="form-group">
                                    <label for="blog_category_name">Blog Category Name</label>
                                    <input type="text" name="blog_category_name" class="form-control"
                                        id="blog_category_name" placeholder="Tên danh mục bài viết"
                                        value="{{ $edit_value->blog_category_name }}">
                                    @error('blog_category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="blog_category_desc">Blog Category Description</label>
                                    <textarea class="form-control" name="blog_category_desc" id="blog_category_desc" placeholder="Mô tả danh mục bài viết"
                                        style="resize:none" rows="8">{{ $edit_value->blog_category_desc }}</textarea>
                                    @error('blog_category_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="category_blog_keywords">Meta Keywords</label>
                                    <input type="text" name="category_blog_keywords" class="form-control"
                                        id="category_blog_keywords" placeholder="Meta Keywords"
                                        value="{{ $edit_value->meta_keywords }}">
                                    @error('category_blog_keywords')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-info">Update Blog Category</button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
