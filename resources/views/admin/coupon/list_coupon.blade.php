@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Liệt kê mã giảm giá
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="row w3-res-tb">
                    <div class="col-sm-5 m-b-xs">
                        <select class="input-sm form-control w-sm inline v-middle">
                            <option value="0">Bulk action</option>
                            <option value="1">Delete selected</option>
                            <option value="2">Bulk edit</option>
                            <option value="3">Export</option>
                        </select>
                        <button class="btn btn-sm btn-default">Apply</button>
                    </div>
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-3">
                        <div class="input-group">
                            <input type="text" class="input-sm form-control" placeholder="Search">
                            <span class="input-group-btn">
                                <button class="btn btn-sm btn-default" type="button">Go!</button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th style="width:20px;">
                                    <label class="i-checks m-b-none">
                                        <input type="checkbox"><i></i>
                                    </label>
                                </th>
                                <th>tên mã giảm giá</th>
                                <th>coupon code</th>
                                <th>coupon times</th>
                                <th>coupon condition</th>
                                <th>coupon number</th>
                                <th>coupon status</th>
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupon as $key => $coupon_item)
                                <tr>
                                    <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td>
                                    <td>{{ $coupon_item->coupon_name }}</td>
                                    <td>{{ $coupon_item->coupon_code }}</td>
                                    <td>{{ $coupon_item->coupon_time }}</td>
                                    <td>
                                        @if ($coupon_item->coupon_condition == 1)
                                            giảm theo phần trăm
                                        @else
                                            giảm theo số tiền
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coupon_item->coupon_number >= 1000)
                                            giảm {{ number_format($coupon_item->coupon_number, 0, ',', '.') }}đ
                                        @elseif ($coupon_item->coupon_number >= 1 && $coupon_item->coupon_number <= 100)
                                            giảm {{ $coupon_item->coupon_number }}%
                                        @else
                                            giảm {{ $coupon_item->coupon_number }}
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-ellipsis">
                                            <?php 
                                            if ($coupon_item->coupon_status == 0){
                                            ?>

                                            <a href="{{ URL::to('/unactive-coupon/' . $coupon_item->coupon_id) }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-up"></span>
                                            </a>

                                            <?php
                                            }else{
                                            ?>

                                            <a href="{{ URL::to('/active-coupon/' . $coupon_item->coupon_id) }}">
                                                <span class="fa-thumb-styling fa fa-thumbs-down"></span>
                                            </a>

                                            <?php
                                            }
                                            ?>
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{URL::to('/edit-coupon/'.$coupon_item->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                                        </a>
                                        <a onclick="return confirm('are you sure to delete?')" href="{{URL::to('/delete-coupon/'.$coupon_item->coupon_id)}}"
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
                            <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
                        </div>
                        <div class="col-sm-7 text-right text-center-xs">
                            {{ $coupon->links() }}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
