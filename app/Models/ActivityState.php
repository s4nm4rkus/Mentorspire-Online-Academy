<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityState extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id', 
        'course_id',
        'activity_id', 
        'completed',
    ];


    public function Course()
{
    return $this->belongsTo(Courses::class, 'course_id');
}


    public function activity()
    {
        return $this->belongsTo(Activities::class, 'activity_id');
    }

   
}

