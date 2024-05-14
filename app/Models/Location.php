<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $table = 'location'; // Specify the table name

    protected $primaryKey = 'Location_ID'; // Specify the primary key column name

    protected $fillable = [
        'LocationName',
        // Add other fillable attributes if needed
    ];

    // Optionally, you can define relationships with other models here
}
