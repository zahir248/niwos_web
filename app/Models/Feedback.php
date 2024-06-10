<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback'; // Specify the table name

    protected $primaryKey = 'Feedback_ID'; // Specify the primary key column name

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'CreationTimeDate',
        'Description',
        'Detail',
        'Suggestion',
        'Impact',
        'Frequency_ID',
        'Severity_ID',
        'Feature_ID',
        'id',
    ];

    // Define the relationship with the Frequency model
    public function frequency()
    {
        return $this->belongsTo(Frequency::class, 'Frequency_ID');
    } 

    // Define the relationship with the Severity model
    public function severity()
    {
        return $this->belongsTo(Severity::class, 'Severity_ID');
    } 

    // Define the relationship with the Feature model
    public function feature()
    {
        return $this->belongsTo(Feature::class, 'Feature_ID');
    } 

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
}
