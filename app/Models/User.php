<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    
    public $timestamps = false; // Disable timestamps

    protected $table = 'users';

    protected $primaryKey = 'id'; // Specify the primary key column name


    public function canAccessPanel(Panel $panel): bool
    {
        if ($this->role === 'admin' && $panel->getId() === 'admin') {
            return true; // Admin users have access to the admin panel
        } 
        
        if ($this->role === 'manager' && $panel->getId() === 'manager') {
            return true; // Managers have access to the manager panel
        }

        return false; // Default to denying access
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'Niwos_ID',
        'UserName',
        'PhoneNumber',
        'DateOfBirth',
        'StartDate',
        'ProfileImage',
        'SecurityImage',
        'AccountStatus_ID',
        'role',
        'Department_ID',
        'Position_ID',
        'Manager_ID',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            //'DateOfBirth' => 'date',
            //'StartDate' => 'date',
            //'ProfileImage' => 'binary',
            //'SecurityImage' => 'binary',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->created_at = now(); // Set CreationTimeDate to current timestamp
            $user->Niwos_ID = static::generateUniqueNiwosID($user->role); // Set Niwos_ID
            $user->AccountStatus_ID = 1; // Set AccountStatus_ID to 1
            $user->password = bcrypt('NewUser'); // Set PassWord to "NewUser"
            $user->UserName = strstr($user->email, '@', true);
        });
    }

    protected static function generateUniqueNiwosID($role)
    {
        // Define prefixes based on role
        $prefixes = [
            'staff' => 'EM', // Staff
            'manager' => 'MG', // Manager
            'admin' => 'AM', // Administrator
        ];

        // Get the prefix based on the role
        $prefix = $prefixes[$role] ?? '';

        if (!$prefix) {
            // If the role is not found in the prefixes array, use a default prefix
            $prefix = 'OT'; // Other
        }
        
        $randomNumber = mt_rand(1000000, 9999999); // Generate a random 7-digit number
        
        // Concatenate prefix and random number
        $niwosID = $prefix . $randomNumber;

        // Ensure the Niwos_ID is unique in the database
        while (static::where('Niwos_ID', $niwosID)->exists()) {
            $randomNumber = mt_rand(1000000, 9999999);
            $niwosID = $prefix . $randomNumber;
        }
        
        return $niwosID;
    }

    public function manager()
    {
        return $this->belongsTo(User::class, 'Manager_ID');
    }

    // Define the relationship with the Position model
    public function position()
    {
        return $this->belongsTo(Position::class, 'Position_ID');
    }

    // Define the relationship with the Department model
    public function department()
    {
        return $this->belongsTo(Department::class, 'Department_ID');
    }

    // Define the relationship with the AccountStatus model
    public function account_status()
    {
        return $this->belongsTo(AccountStatus::class, 'AccountStatus_ID');
    }

}
