<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeaveRequest extends Model
{
    use HasFactory;

    protected $table = 'leave_request'; // Specify the table name

    protected $primaryKey = 'LeaveRequest_ID'; // Specify the primary key column name

    public $timestamps = false; // Disable timestamps

    protected $fillable = [
        'NW_LeaveRequest_ID',
        'StartDate',
        'EndDate',
        'Duration',
        'SubmissionTimeDate',
        'Reason',
        'ResponseTimeDate',
        'Comment',
        'LeaveRequestStatus_ID',
        'LeaveType_ID',
        'id',
    ];

    // Define the relationship with the LeaveType model
    public function leave_type()
    {
        return $this->belongsTo(LeaveType::class, 'LeaveType_ID');
    } 

    // Define the relationship with the LeaveRequestStatus model
    public function leave_request_status()
    {
        return $this->belongsTo(LeaveRequestStatus::class, 'LeaveRequestStatus_ID');
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
        return $this->Duration . ' days';
    }
}
