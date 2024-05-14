<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment'; // Specify the table name

    protected $primaryKey = 'Payment_ID'; // Specify the primary key column name

    protected $fillable = [
        'NW_Payment_ID',
        'Amount',
        'PaymentTimeDate',
        'Currency',
        'Method_ID',
        'Location_ID',
        'id',
    ];

    // Define the relationship with the Method model
    public function method()
    {
        return $this->belongsTo(Method::class, 'Method_ID');
    }

    // Define the relationship with the Location model
    public function location()
    {
        return $this->belongsTo(Location::class, 'Location_ID');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    
}
