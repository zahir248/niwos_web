<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Frequency extends Model
{
    use HasFactory;

    protected $table = 'frequency'; // Specify the table name

    protected $primaryKey = 'Frequency_ID'; // Specify the primary key column name

    protected $fillable = [
        'FrequencyName',
        // Add other fillable attributes if needed
    ];
}
