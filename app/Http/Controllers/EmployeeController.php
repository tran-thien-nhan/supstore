<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
use App\Models\District;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Admin::whereIn('role_value', [1, 2])->paginate(5);

        return view('admin.all_employees', compact('employees'));
    }

    public function editEmployee($admin_id)
    {
        $employee = Admin::findOrFail($admin_id);
        $districts = District::all(); // Lấy danh sách quận từ bảng tbl_district
        $roles = Role::all(); // Lấy danh sách vai trò từ bảng tbl_role

        return view('admin.edit_employee', compact('employee', 'districts', 'roles'));
    }

    public function updateEmployee(Request $request, $admin_id)
    {
        $employee = Admin::findOrFail($admin_id);

        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:tbl_admin,admin_email,' . $admin_id . ',admin_id',
            'admin_phone' => 'required',
            'address' => 'nullable',
            'salary' => 'required|numeric',
            'district_id' => 'required|exists:tbl_district,district_id',
            'role_id' => 'required|exists:tbl_role,role_id',
        ]);

        // Cập nhật thông tin nhân viên từ dữ liệu trong $request
        $employee->admin_name = $request->input('admin_name');
        $employee->admin_email = $request->input('admin_email');
        $employee->admin_phone = $request->input('admin_phone');
        $employee->address = $request->input('address');
        $employee->salary = $request->input('salary');
        $employee->district_id = $request->input('district_id');
        $employee->role_id = $request->input('role_id');

        // Cập nhật mã nhân viên
        $roleValue = $employee->role_value;
        $adminId = $employee->admin_id;
        $adminCode = ($roleValue == 1 ? 'NV' : ($roleValue == 2 ? 'SP' : '')) . '-' . str_pad($adminId, 2, '0', STR_PAD_LEFT);
        $employee->admin_code = $adminCode;

        $employee->save();

        return redirect('/employees')->with('success', 'update successfully');
    }

    public function deleteEmployee($admin_id)
    {
        $employee = Admin::findOrFail($admin_id);
        $employee->delete();

        return redirect('/employees')->with('success', 'delete successfully');
    }
}
