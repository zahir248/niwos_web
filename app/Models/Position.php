<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

    protected $table = 'position'; // Specify the table name

    protected $primaryKey = 'Position_ID'; // Specify the primary key column name

    protected $fillable = [
        'PositionName',
        // Add other fillable attributes if needed
    ];

    // Optionally, you can define relationships with other models here
}
