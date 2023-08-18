<?php

namespace App\Models;

use App\Models\Role;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Model implements Authenticatable
{
    use Notifiable;

    // Định nghĩa các phương thức yêu cầu của giao diện Authenticatable
    public function getAuthIdentifierName()
    {
        return 'admin_id'; // Thay 'admin_id' bằng tên trường chứa khóa chính của bảng tbl_admin
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->admin_password; // Thay 'admin_password' bằng tên trường chứa mật khẩu của bảng tbl_admin
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    // Nếu bạn cần hỗ trợ các phương thức khác của giao diện Authenticatable, bạn có thể triển khai chúng ở đây.
    protected $fillable = [
        'admin_email', 'admin_password',  'admin_name', 'admin_phone', 'role_value', 'role_id'
    ];

    protected $primaryKey = 'admin_id';
    protected $table = 'tbl_admin';
    public function social()
    {
        return $this->hasOne(Social::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
