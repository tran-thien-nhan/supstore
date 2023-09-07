@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Update Brand Product
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
                    @foreach ($edit_brand_product as $key => $edit_value)
                        <div class="position-center">
                            <form role="form" action="{{ URL::to('/update-brand-product/' . $edit_value->brand_id) }}"
                                method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="brand_product_name">Brand Name</label>
                                    <input type="text" value="{{ $edit_value->brand_name }}" name="brand_product_name"
                                        class="form-control" id="brand_product_name" placeholder="tên thương hiệu">
                                    @error('brand_product_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="brand_product_desc">Brand Description</label>
                                    <textarea class="form-control" name="brand_product_desc" id="brand_product_desc" placeholder="mô tả thương hiệu"
                                        style="resize:none" rows="8">{{ $edit_value->brand_desc }}</textarea>
                                    @error('brand_product_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" name="update_brand_product" class="btn btn-info">update Brand</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </section>

        </div>
    </div>
@endsection
