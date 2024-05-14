<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Import Carbon

class Wallet extends Model
{
    use HasFactory;

    public $timestamps = false; // Disable timestamps

    protected $table = 'wallet'; // Specify the table name

    protected $primaryKey = 'Wallet_ID'; // Specify the primary key column name

    protected $fillable = [
        'Balance',
        'CreationTimeDate',
        'LastTransactionTimeDate',
        'id',
    ];

    // Mutator for CreationTimeDate
    public function setCreationTimeDateAttribute($value)
    {
        $this->attributes['CreationTimeDate'] = Carbon::parse($value)->setTimezone('Asia/Kuala_Lumpur');
    }

    // Mutator for LastTransactionTimeDate
    public function setLastTransactionTimeDateAttribute($value)
    {
        $this->attributes['LastTransactionTimeDate'] = $value ? Carbon::parse($value)->setTimezone('Asia/Kuala_Lumpur') : null;
    }

    // Accessor for CreationTimeDate
    public function getCreationTimeDateAttribute($value)
    {
        return Carbon::parse($value)->setTimezone('Asia/Kuala_Lumpur');
    }

    // Accessor for LastTransactionTimeDate
    public function getLastTransactionTimeDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->setTimezone('Asia/Kuala_Lumpur') : null;
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
