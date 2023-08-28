<?php

namespace App\Models;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    protected $fillable = [
        'role_name', 'role_value', 'salary'
    ];

    protected $primaryKey = 'role_id';
    protected $table = 'tbl_role';
}
