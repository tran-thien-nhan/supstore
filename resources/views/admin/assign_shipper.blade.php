@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Gán shipper cho đơn hàng
            </header>
            <div class="panel-body">
                <!-- Hiển thị thông tin đơn hàng, ví dụ: -->
                <p>Đơn hàng: {{ $order->order_id }}</p>
                <p>Địa chỉ: {{ $order->order_address }}</p>

                <!-- Hiển thị danh sách shipper -->
                <form action="{{ URL::to('/assign-shipper/' . $order->order_id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $order->order_id }}">
                    <div class="form-group">
                        <label for="shipper_id">Chọn shipper:</label>
                        <select class="form-control" id="shipper_id" name="shipper_id">
                            @foreach ($shippers as $shipper)
                                <option value="{{ $shipper->admin_id }}">{{ $shipper->admin_name }}</option>
                            @endforeach
                        </select>                        
                    </div>
                    <button type="submit" class="btn btn-primary">Gán shipper</button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection
