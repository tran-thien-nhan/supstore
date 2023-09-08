<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use Notifiable;

    // Định nghĩa các phương thức yêu cầu của giao diện Authenticatable
    public function getAuthIdentifierName()
    {
        return 'customer_id'; // Thay 'customer_id' bằng tên trường chứa khóa chính của bảng tbl_admin
    }

    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    public function getAuthPassword()
    {
        return $this->customer_password; // Thay 'customer_password' bằng tên trường chứa mật khẩu của bảng tbl_admin
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

    protected $table = 'tbl_customer'; // Đặt tên bảng cần truy vấn
    protected $primaryKey = 'customer_id'; // Đặt tên khóa chính
    protected $fillable = ['district_id', 'customer_name', 'customer_email', 'customer_password', 'customer_phone', 'customer_address', 'customer_point'];
    public function district()
    {
        return $this->belongsTo(District::class, 'district_id');
    }
}
