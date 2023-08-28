<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'tbl_district'; // Đặt tên bảng cần truy vấn
    protected $primaryKey = 'district_id'; // Đặt tên khóa chính
    protected $fillable = ['district_name'];
}
