<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    use HasFactory;

    protected $table = 'leave_type'; // Specify the table name

    protected $primaryKey = 'LeaveType_ID'; // Specify the primary key column name

    protected $fillable = [
        'Type',
        // Add other fillable attributes if needed
    ];
}
