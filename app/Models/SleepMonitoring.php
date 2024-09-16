<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SleepMonitoring extends Model
{
    use HasFactory;
    protected $table = 'sleep_monitoring';
    protected $fillable = [
        'user_id',
        'snoring_level',
        'heart_rate',
        'sp02',
        'serial_key',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
