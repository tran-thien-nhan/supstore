<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    protected $table = 'tbl_category_blog'; // Đặt tên bảng cần truy vấn
    protected $primaryKey = 'blog_category_id'; // Đặt tên khóa chính
    protected $fillable = ['blog_category_name', 'blog_category_desc', 'blog_category_status'];
}
