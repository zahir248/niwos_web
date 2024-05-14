<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRequestStatus extends Model
{
    use HasFactory;

    protected $table = 'access_request_status'; // Specify the table name

    protected $primaryKey = 'AccessRequestStatus_ID'; // Specify the primary key column name

    protected $fillable = [
        'Status',
        // Add other fillable attributes if needed
    ];
}
