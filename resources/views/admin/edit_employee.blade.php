@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    UPDATE EMPLOYEE INFO
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{ URL::to('/update-employee/' . $employee->admin_id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="admin_name">Employee Name</label>
                                <input type="text" class="form-control" name="admin_name"
                                    value="{{ $employee->admin_name }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="admin_email">Email</label>
                                <input type="email" class="form-control" name="admin_email"
                                    value="{{ $employee->admin_email }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="admin_phone">Phone</label>
                                <input type="text" class="form-control" name="admin_phone"
                                    value="{{ $employee->admin_phone }}">
                                @error('admin_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ $employee->address }}">
                                @error('address')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="district_id">District</label>
                                <select class="form-control" name="district_id">
                                    <option value="">-- Choose District --</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->district_id }}"
                                            {{ $district->district_id == $employee->district_id ? 'selected' : '' }}>
                                            {{ $district->district_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="role_id">Role</label>
                                <select class="form-control" name="role_value">
                                    <option value="">-- Choose role --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->role_value }}"
                                            {{ $role->role_value == $employee->role_value ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="salary">Salary</label>
                                <select class="form-control" name="salary">
                                    <option value="">-- Choose Salary --</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->salary }}"
                                            {{ $role->role_id == $employee->role_id ? 'selected' : '' }}>
                                            {{ $role->role_name }} - {{ number_format($role->salary, 0, ',', '.') }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
