<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail; 
use App\Mail\EmailAbormalityDetected;
use App\Notifications\AbnormalityDetectedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Traits\HasPermissions;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;




class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;
    

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'role',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sleepMonitoring()
    {
        return $this->hasMany(SleepMonitoring::class);
    }

    public function startMonitor()
    {
        $this->start_monitor = 1;
        $this->save();
    }

    public function stopMonitor()
    {
        $this->start_monitor = null;
        $this->save();
    }

    /**
     * Send the Abnormality Detected notification.
     *
     * @param  array  $data
     * @return void
     */
    public function sendAbnormalityDetectedNotification($data): void
    {
        $this->notify(new AbnormalityDetectedNotification($data));
    }

    /**
     * store the notification.
     *
     * @param  array  $data
     */
    public function storeNotification($data)
    {
        return $this->notifications()->create([
            'id' => Str::uuid(),
            'type' =>   (new AbnormalityDetectedNotification()),
            'data' => [
                'snoring_level' => $data['snoring_level'],
                'heart_rate' => $data['heart_rate'],
                'sp02' => $data['sp02'],
            ]
        ]);
    }

    public function courses()
    {
        return $this->belongsToMany(Courses::class, 'course_user', 'user_id', 'course_id');
    }
    
    public function activityStates()
    {
        return $this->hasMany(ActivityState::class, 'user_id');
    }

}