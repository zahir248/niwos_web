<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedAccessLog extends Model
{
    use HasFactory;

    protected $table = 'deleted_access_log'; // Specify the table name

    public $timestamps = false; // Disable timestamps

    protected $primaryKey = 'DeletedAccess_ID'; // Specify the primary key column name

    protected $fillable = [
        'id',
        'AccessArea_ID',
        'StartTimeDate',
        'EndTimeDate',
        'Reason',
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
