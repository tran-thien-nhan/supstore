@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Danh sách nhân viên
                </div>
                @if (session('success'))
                    <div class="alert alert-success">
                        <strong>Success!</strong> {{ session('success') }}
                    </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-striped b-t b-light">
                        <thead>
                            <tr>
                                <th>Mã NV</th>
                                <th>Tên nhân viên</th>
                                <th>Vai trò</th>
                                <th>Email</th>
                                <th>Số điện thoại</th>
                                <th>Địa chỉ</th>
                                <th>quận</th>
                                <th>Lương</th>
                                <th>action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $key => $employee)
                                <tr>
                                    <td>{{ $employee->admin_code }}</td>
                                    <td>{{ $employee->admin_name }}</td>
                                    <td>
                                        @if ($employee->role_value == 1)
                                            Nhân viên
                                        @elseif ($employee->role_value == 2)
                                            Shipper
                                        @else
                                            Không xác định
                                        @endif
                                    </td>
                                    <td>{{ $employee->admin_email }}</td>
                                    <td>{{ $employee->admin_phone }}</td>
                                    <td>
                                        @if ($employee->address)
                                            {{ $employee->address }}
                                        @else
                                            @if ($employee->district)
                                                {{ $employee->district->district_name }}
                                            @else
                                                Không xác định
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $employee->district->district_name }}</td>
                                    <td>{{ number_format($employee->salary, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="{{ URL::to('/edit-employee/' . $employee->admin_id) }}"
                                            class="active styling-edit" ui-toggle-class="">
                                            <i class="fa fa-pencil-square-o text-success text-active"></i>
                                        </a>
                                        <a onclick="return confirm('are you sure to delete?')"
                                            href="{{ URL::to('/delete-employee/' . $employee->admin_id) }}"
                                            class="active styling-delete" ui-toggle-class="">
                                            <i class="fa fa-trash text-danger text"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $employees->links() }}
            </div>
        </div>
    </div>
@endsection
