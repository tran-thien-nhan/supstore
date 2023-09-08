<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Admin;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Admin::whereIn('role_value', [1, 2])->paginate(5);
        $districts = District::all();
        return view('admin.all_employees', compact('employees', 'districts'));
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
        $$request->validate([
            'admin_name' => 'required',
            'admin_email' => 'required|email|unique:tbl_admin,admin_email,' . $admin_id . ',admin_id',
            'admin_phone' => 'required',
            'address' => 'nullable',
            'salary' => 'required|numeric',
            'district_id' => 'required|exists:tbl_district,district_id',
            'role_value' => 'required|in:1,2', // Đảm bảo rằng role_value chỉ có thể là 1 hoặc 2
        ], [
            'required' => 'The :attribute field is required.',
            'email' => 'The :attribute must be a valid email address.',
            'unique' => 'The :attribute has already been taken.',
            'numeric' => 'The :attribute must be a number.',
            'exists' => 'The selected :attribute is invalid.',
            'in' => 'The selected :attribute is invalid.',
        ]);

        // Cập nhật thông tin nhân viên từ dữ liệu trong $request
        $employee->admin_name = $request->input('admin_name');
        $employee->admin_email = $request->input('admin_email');
        $employee->admin_phone = $request->input('admin_phone');
        $employee->address = $request->input('address');
        $employee->salary = $request->input('salary');
        $employee->district_id = $request->input('district_id');
        $employee->role_value = $request->input('role_value'); // Cập nhật trường role_value

        // Cập nhật mã nhân viên
        $roleValue = $employee->role_value;
        $adminId = $employee->admin_id;
        $adminCode = ($roleValue == 1 ? 'NV' : ($roleValue == 2 ? 'SP' : '')) . '-' . str_pad($adminId, 2, '0', STR_PAD_LEFT);
        $employee->admin_code = $adminCode;

        $employee->save();

        return redirect('/employees')->with('success', 'update successfully');
    }


    public function filterEmployees(Request $request)
    {
        $employeeType = $request->input('employee_type');

        // Query dựa trên loại nhân viên được chọn
        if ($employeeType == 'all') {
            $employees = Admin::paginate(10); // Sử dụng tên model và phương thức paginate của Laravel
        } else {
            $employees = Admin::where('role_value', $employeeType)->get();
        }

        return view('admin.all_employees', compact('employees'));
    }

    public function searchEmployees(Request $request)
    {
        $searchQuery = $request->input('search');

        $employees = Admin::where('admin_id', 'LIKE', "%$searchQuery%")
            ->orWhere('admin_name', 'LIKE', "%$searchQuery%")
            ->orWhere('admin_phone', 'LIKE', "%$searchQuery%") // Thêm điều kiện tìm kiếm theo số điện thoại
            ->orWhereHas('district', function ($query) use ($searchQuery) {
                $query->where('district_name', 'LIKE', "%$searchQuery%");
            })
            ->paginate(10);

        return view('admin.all_employees', compact('employees'));
    }
}
