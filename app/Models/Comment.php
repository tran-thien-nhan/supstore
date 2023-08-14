<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\Customer;

class Comment extends Model
{
    protected $table = 'tbl_comments';
    protected $fillable = ['product_id', 'customer_id', 'content', 'approved'];
    protected $primaryKey = 'comment_id'; // Đặt tên khóa chính
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
