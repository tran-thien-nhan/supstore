<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'tbl_blog'; // Đặt tên bảng cần truy vấn
    protected $primaryKey = 'blog_id'; // Đặt tên khóa chính
    protected $fillable = ['blog_title', 'blog_thumbnail', 'blog_category', 'pre_blog_content', 'blog_content'];
}
