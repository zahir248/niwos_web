<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'department'; // Specify the table name

    protected $primaryKey = 'Department_ID'; // Specify the primary key column name

    protected $fillable = [
        'DepartmentName',
        // Add other fillable attributes if needed
    ];

    // Optionally, you can define relationships with other models here
}
