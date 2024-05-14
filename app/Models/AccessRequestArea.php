<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessRequestArea extends Model
{
    use HasFactory;

    protected $table = 'access_request_area'; // Specify the table name

    protected $primaryKey = 'AccessRequestArea_ID'; // Specify the primary key column name

    protected $fillable = [
        'AreaName',
        // Add other fillable attributes if needed
    ];
}
