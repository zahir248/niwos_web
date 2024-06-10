<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Severity extends Model
{
    use HasFactory;

    protected $table = 'severity'; // Specify the table name

    protected $primaryKey = 'Severity_ID'; // Specify the primary key column name

    protected $fillable = [
        'SeverityName',
        // Add other fillable attributes if needed
    ];
}
