<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    use HasFactory;

    protected $table = 'user_access_area'; // Specify the table name

    protected $primaryKey = 'UserAccessArea_ID'; // Specify the primary key column name

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'id',
        'AccessArea_ID',
        'StartTimeDate',
        'EndTimeDate',
    ];

    // Define the relationship with the AccessArea model
    public function access_area()
    {
        return $this->belongsTo(AccessArea::class, 'AccessArea_ID');
    } 

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
