<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;

    protected $table = 'feature'; // Specify the table name

    protected $primaryKey = 'Feature_ID'; // Specify the primary key column name

    protected $fillable = [
        'FeatureName',
        // Add other fillable attributes if needed
    ];
}
