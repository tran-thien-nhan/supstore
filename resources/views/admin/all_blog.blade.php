@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    BLOG LIST
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="row w3-res-tb">
                    <div class="col" style="margin-left:1rem; margin-bottom:1rem">

                    </div>
                    <div class="col-sm-3 m-b-xs dropdown">
                        <div class="category-group">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="categoryDropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                --Select a Category--
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                <li value="all"><a class="dropdown-item" href="{{ URL::to('/all-blog') }}">ALL</a>
                                </li>
                                {{-- @foreach ($all_category_blog as $key => $cate_blog)
                                    <li value="{{ $cate_blog->blog_category_name }}">
                                        <a class="dropdown-item"
                                            href="{{ URL::to('/all-blog/category-blog/' . $cate_blog->blog_category_id ) }}">{{ $cate_blog->blog_category_name }}</a>
                                    </li>
                                @endforeach --}}
                                @foreach ($all_category_blog as $key => $cate_blog)
                                    <li value="{{ $cate_blog->blog_category_name }}">
                                        <a class="dropdown-item"
                                            href="{{ URL::to('/all-blog/category-blog/' . $cate_blog->blog_category_id) }}?category_id={{ $cate_blog->blog_category_id }}"
                                            @if (request('category_id') == $cate_blog->blog_category_id) style="font-weight: bold" @endif>
                                            {{ $cate_blog->blog_category_name }}
                                        </a>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        {{-- <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="button">Go!</button>
                            </span>
                        </div> --}}
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                {{-- <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th> --}}
                                <th>Blog Title</th>
                                <th>Blog Thumbnail</th>
                                <th>Blog Category</th>
                                <th>Visibility</th>
                                <th>Created Date</th>
                                {{-- <th>mô tả </th> --}}
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_blog as $key => $blog)
                                <tr>
                                    {{-- <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td> --}}
                                    <td>{{ $blog->blog_title }}</td>
                                    <td>
                                        <img src="{{ asset('public/uploads/blog/' . $blog->blog_thumbnail) }}"
                                            height="100" width="100" alt="">
                                    </td>
                                    <td>{{ $blog->blog_category_name }}</td>
                                    <td>
                                        <span class="text-ellipsis">
                                            <?php 
                                            if ($blog->blog_status == 0){
                                            ?>

                                            <a href="{{ URL::to('/unactive-blog/' . $blog->blog_id) }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                            </a>

                                            <?php
                                            }else{
                                            ?>

                                            <a href="{{ URL::to('/active-blog/' . $blog->blog_id) }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                            </a>

                                            <?php
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td>{{ $blog->updated_at }}</td>
                                    <td>
                                        <a href="{{ URL::to('/edit-blog/' . $blog->blog_id) }}" class="active styling-edit"
                                            ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                                        </a>
                                        <a onclick="return confirm('are you sure to delete?')"
                                            href="{{ URL::to('/delete-blog/' . $blog->blog_id) }}"
                                            class="active styling-delete" ui-toggle-class="">
                                            <i class="fa fa-trash text-danger text"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
                <footer class="panel-footer">
                    <div class="row">

                        <div class="col-sm-5 text-center">
                            {{-- <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small> --}}
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            {{ $all_blog->links() }}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
