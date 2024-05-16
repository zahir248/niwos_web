<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AccessRequest extends Model
{
    use HasFactory;

    protected $table = 'access_request'; // Specify the table name

    protected $primaryKey = 'AccessRequest_ID'; // Specify the primary key column name

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'NW_AccessRequest_ID',
        'StartTimeDate',
        'EndTimeDate',
        'Duration',
        'SubmissionTimeDate',
        'Reason',
        'ResponseTimeDate',
        'Comment',
        'AccessRequestArea_ID',
        'AccessRequestStatus_ID',
        'id',
    ];

    // Define the relationship with the AccessRequestArea model
    public function access_request_area()
    {
        return $this->belongsTo(AccessRequestArea::class, 'AccessRequestArea_ID');
    } 

    // Define the relationship with the AccessRequestStatus model
    public function access_request_status()
    {
        return $this->belongsTo(AccessRequestStatus::class, 'AccessRequestStatus_ID');
    } 

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    // Automatically set ResponseTimeDate before saving the model
    public static function boot()
    {
        parent::boot();

        static::saving(function ($accessRequest) {
            // Check if ResponseTimeDate is not already set
            if (!$accessRequest->ResponseTimeDate) {
                // Get the current datetime
                $currentTime = Carbon::now();
    
                // Convert to Malaysia time (UTC+8)
                $malaysiaTime = $currentTime->copy()->addHours(8);
    
                // Set ResponseTimeDate to Malaysia time
                $accessRequest->ResponseTimeDate = $malaysiaTime;
            }
        });
    }

    // Custom attribute to format Duration
    public function getFormattedDurationAttribute()
    {
        $minutes = $this->Duration;
        $days = floor($minutes / (60 * 24));
        $hours = floor(($minutes % (60 * 24)) / 60);
        $mins = $minutes % 60;

        $formatted = '';

        if ($days > 0) {
            $formatted .= $days . ' days ';
        }
        if ($hours > 0) {
            $formatted .= $hours . ' hours ';
        }
        if ($mins > 0) {
            $formatted .= $mins . ' minutes';
        }

        return trim($formatted);
    }
}
