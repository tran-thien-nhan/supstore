<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'tbl_product'; // Tên thực tế của bảng sản phẩm
    protected $primaryKey = 'product_id'; // Đặt tên khóa chính
    protected $fillable = ['product_id', 'category_id', 'brand_id', 'product_name', 'product_quantity', 'product_desc', 'product_content', 'product_price', 'product_discount', 'product_image', 'product_flavour', 'product_status'];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'product_id');
    }
}