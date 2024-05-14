<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance'; // Specify the table name

    protected $primaryKey = 'Attendance_ID'; // Specify the primary key column name

    protected $fillable = [
        'NW_Attendance_ID',
        'PunchInTime',
        'PunchOutTime',
        'AttendanceDate',
        'ShiftSession_ID',
        'AttendanceStatus_ID',
        'id',
    ];

    // Define the relationship with the AttendanceStatus model
    public function attendance_status()
    {
        return $this->belongsTo(AttendanceStatus::class, 'AttendanceStatus_ID');
    } 

    // Define the relationship with the ShiftSession model
    public function shift_session()
    {
        return $this->belongsTo(ShiftSession::class, 'ShiftSession_ID');
    }

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function getPunchInTimeAttribute($value)
    {
        return $value ? date('h:i A', strtotime($value)) : '--';
    }

    public function getPunchOutTimeAttribute($value)
    {
        return $value ? date('h:i A', strtotime($value)) : '--';
    }
}
