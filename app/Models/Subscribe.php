<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscribe extends Model
{
    protected $table = 'tbl_subscribe';
    protected $primaryKey = 'subscribe_id';
    protected $fillable = ['email_subscribe'];
}
