@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    COUPON LIST
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="row w3-res-tb">
                    <a href="{{ route('create-batch-coupon') }}" class="btn btn-success">Create Batch Of Coupons</a>
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
                                <th>Coupon name</th>
                                <th>coupon code</th>
                                <th>coupon quantity</th>
                                <th>coupon condition</th>
                                <th>coupon number</th>
                                <th>Expired date</th>
                                <th>Condition</th>
                                {{-- <th>coupon status</th> --}}
                                <th style="width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupon as $key => $coupon_item)
                                <tr>
                                    {{-- <td><label class="i-checks m-b-none"><input type="checkbox"
                                                name="post[]"><i></i></label>
                                    </td> --}}
                                    <td>{{ $coupon_item->coupon_name }}</td>
                                    <td>{{ $coupon_item->coupon_code }}</td>
                                    <td>{{ $coupon_item->coupon_time }}</td>
                                    <td>
                                        @if ($coupon_item->coupon_condition == 1)
                                            discount by percentage
                                        @else
                                            discount by amount
                                        @endif
                                    </td>
                                    <td>
                                        @if ($coupon_item->coupon_number >= 1000)
                                            discount {{ number_format($coupon_item->coupon_number, 0, ',', '.') }}đ
                                        @elseif ($coupon_item->coupon_number >= 1 && $coupon_item->coupon_number <= 100)
                                            discount {{ $coupon_item->coupon_number }}%
                                        @else
                                            discount {{ $coupon_item->coupon_number }}
                                        @endif
                                    </td>
                                    <td>{{ $coupon_item->coupon_expire_date }}</td>

                                    @php
                                        $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
                                    @endphp

                                    <td>
                                        @if ($coupon_item->coupon_time != 0 && $coupon_item->coupon_expire_date > $currentDate)
                                            <span class="badge bg-success" style="color:white">still valid</span>
                                        @else
                                            <span class="badge bg-danger" style="color:white">expired</span>
                                        @endif
                                    </td>


                                    {{-- <td>
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
                                    </td> --}}
                                    <td>
                                        <a href="{{ URL::to('/edit-coupon/' . $coupon_item->coupon_id) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                                        </a>
                                        <a onclick="return confirm('are you sure to delete?')"
                                            href="{{ URL::to('/delete-coupon/' . $coupon_item->coupon_id) }}"
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
                            {{ $coupon->links() }}
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
@endsection
