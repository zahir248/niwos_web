<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Method extends Model
{
    use HasFactory;

    protected $table = 'method'; // Specify the table name

    protected $primaryKey = 'Method_ID'; // Specify the primary key column name

    protected $fillable = [
        'MethodType',
        // Add other fillable attributes if needed
    ];

    // Optionally, you can define relationships with other models here
}
