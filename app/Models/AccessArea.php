<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AccessRequestArea; // Import the AccessRequestArea model

class AccessArea extends Model
{
    use HasFactory;

    protected $table = 'access_area'; // Specify the table name

    protected $primaryKey = 'AccessArea_ID'; // Specify the primary key column name
    
    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'AreaName',
    ];

    // Auto-generate AccessCode when creating
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->AccessCode = self::generateAccessCode($model->AreaName);
        });

        static::deleting(function ($model) {
            // Delete the corresponding entry in access_request_area table
            AccessRequestArea::where('AreaName', $model->AreaName)->delete();
        });
    }

    // Method to generate AccessCode
    public static function generateAccessCode($areaName)
    {
        // Take the first character of the AreaName and capitalize it
        $prefix = strtoupper(substr($areaName, 0, 1));

        // Define the possible suffixes
        $suffixes = ['_Access2024!', '_Access24!', 'Access2024!', 'Access24!'];

        // Randomly select a suffix
        $suffix = $suffixes[array_rand($suffixes)];

        // Combine to form the AccessCode
        return $prefix . $suffix;
    }
}
