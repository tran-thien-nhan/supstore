@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    UPDATE ORDER STATUS
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
                            <label for="new_status">choose order status:</label>
                            <select class="form-control" id="order_status" name="order_status">
                                <option value="1" {{ $edit_order_status->order_status == 1 ? 'selected' : '' }}>order
                                    in process</option>
                                <option value="2" {{ $edit_order_status->order_status == 2 ? 'selected' : '' }}>in
                                    shipping</option>
                                <option value="3" {{ $edit_order_status->order_status == 3 ? 'selected' : '' }}>ship
                                    successfully</option>
                                <option value="4" {{ $edit_order_status->order_status == 4 ? 'selected' : '' }}>order
                                    refunded</option>
                                <option value="5" {{ $edit_order_status->order_status == 5 ? 'selected' : '' }}>order
                                    cancelled</option>
                            </select>
                        </div>
                        @if ($admin_role_value != 2)
                            {{-- Kiểm tra nếu không phải là shipper --}}
                            <div class="form-group">
                                <label for="shipper_id">Choose new shipper:</label>
                                <select class="form-control" id="shipper_id" name="shipper_id">
                                    @foreach ($shippers as $shipper)
                                        <option value="{{ $shipper->admin_id }}"
                                            {{ $selectedShipperId == $shipper->admin_id ? 'selected' : '' }}>
                                            {{ $shipper->admin_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ URL::to('/manage-order') }}" class="btn btn-warning">Back</a>
                    </form>
                </div>
            </section>
        </div>
    </div>
@endsection
