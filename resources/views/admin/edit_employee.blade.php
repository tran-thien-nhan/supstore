@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật thông tin nhân viên
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{ URL::to('/update-employee/' . $employee->admin_id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="admin_name">Tên nhân viên</label>
                                <input type="text" class="form-control" name="admin_name"
                                    value="{{ $employee->admin_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="admin_email">Email</label>
                                <input type="email" class="form-control" name="admin_email"
                                    value="{{ $employee->admin_email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="admin_phone">Số điện thoại</label>
                                <input type="text" class="form-control" name="admin_phone"
                                    value="{{ $employee->admin_phone }}">
                            </div>
                            <div class="form-group">
                                <label for="address">Địa chỉ</label>
                                <input type="text" class="form-control" name="address" value="{{ $employee->address }}">
                            </div>
                            <div class="form-group">
                                <label for="district_id">Quận</label>
                                <select class="form-control" name="district_id">
                                    <option value="">-- Chọn quận --</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->district_id }}"
                                            {{ $district->district_id == $employee->district_id ? 'selected' : '' }}>
                                            {{ $district->district_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role_id">Vai trò</label>
                                <select class="form-control" name="role_id">
                                    <option value="">-- Chọn vai trò --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_id }}"
                                            {{ $role->role_id == $employee->role_id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="salary">Lương</label>
                                <select class="form-control" name="salary">
                                    <option value="">-- Chọn lương --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->salary }}"
                                            {{ $role->role_id == $employee->role_id ? 'selected' : '' }}>
                                            {{ $role->role_name }} - {{ number_format($role->salary, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
