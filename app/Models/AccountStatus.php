<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountStatus extends Model
{
    use HasFactory;

    protected $table = 'account_status'; // Specify the table name

    protected $primaryKey = 'AccountStatus_ID'; // Specify the primary key column name

    protected $fillable = [
        'Status',
        // Add other fillable attributes if needed
    ];

    // Optionally, you can define relationships with other models here
}
