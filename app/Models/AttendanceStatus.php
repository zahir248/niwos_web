<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceStatus extends Model
{
    use HasFactory;

    protected $table = 'attendance_status'; // Specify the table name

    protected $primaryKey = 'AttendanceStatus_ID'; // Specify the primary key column name

    protected $fillable = [
        'Status',
        // Add other fillable attributes if needed
    ];

    // Optionally, you can define relationships with other models here
}
