@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Cập nhật tình trạng đơn hàng
            </header>
            <div class="panel-body">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif

                <form action="{{ URL::to('/update-order-status/' . $edit_order_status->order_id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="new_status">Chọn tình trạng mới:</label>
                        <select class="form-control" id="order_status" name="order_status">
                            <option value="1" {{ $edit_order_status->order_status == 1 ? 'selected' : '' }}>Đang xử lý đơn hàng</option>
                            <option value="2" {{ $edit_order_status->order_status == 2 ? 'selected' : '' }}>Đang giao hàng</option>
                            <option value="3" {{ $edit_order_status->order_status == 3 ? 'selected' : '' }}>Giao hàng thành công</option>
                            <option value="4" {{ $edit_order_status->order_status == 4 ? 'selected' : '' }}>Trả lại hàng</option>
                            <option value="5" {{ $edit_order_status->order_status == 5 ? 'selected' : '' }}>Hủy hàng</option>
                        </select>                        
                    </div>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </section>
    </div>
</div>
@endsection