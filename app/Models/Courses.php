<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    
    protected $table = 'course_tbl';
    protected $fillable = [
        'course_poster',
        'course_title',
        'course_code',
        'course_description',
        'progress_activity',
    ];
    
    public function activities()
    {
        return $this->hasMany(Activities::class, 'course_id', 'id');
    }

    public function ActivityState(){
        return $this->hasMany(ActivityState::class, 'course_id', 'id');
    }

    public function DocumentHandouts(){
        return $this -> hasMany(DocumentHandouts::class,  'course_id', 'id');
    }
    public function ImageHandouts(){
        return $this -> hasMany(ImageHandouts::class,  'course_id', 'id');
    }

    public function VideoHandouts(){
        return $this -> hasMany(VideoHandouts::class,  'course_id', 'id');
    }

    public function users()
{
    return $this->belongsToMany(User::class, 'course_user', 'course_id', 'user_id');
}



}
