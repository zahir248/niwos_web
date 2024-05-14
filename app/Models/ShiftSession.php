<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftSession extends Model
{
    use HasFactory;

    protected $table = 'shift_session'; // Specify the table name

    protected $primaryKey = 'ShiftSession_ID'; // Specify the primary key column name

    protected $fillable = [
        'Session',
        // Add other fillable attributes if needed
    ];

    // Optionally, you can define relationships with other models here
}
