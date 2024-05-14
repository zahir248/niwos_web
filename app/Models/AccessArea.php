<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccessArea extends Model
{
    use HasFactory;

    protected $table = 'access_area'; // Specify the table name

    protected $primaryKey = 'AccessArea_ID'; // Specify the primary key column name

    protected $fillable = [
        'AreaName',
        'AccessCode',
    ];
}
