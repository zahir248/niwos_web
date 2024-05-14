<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRequestStatus extends Model
{
    use HasFactory;

    protected $table = 'leave_request_status'; // Specify the table name

    protected $primaryKey = 'LeaveRequestStatus_ID'; // Specify the primary key column name

    protected $fillable = [
        'Status',
        // Add other fillable attributes if needed
    ];
}
