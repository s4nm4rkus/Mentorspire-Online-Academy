<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;


    protected $table = 'activity_tbl';
    protected $fillable = [
        'activity_number',
        'activity_title',
        'activity_description',
        'course_id',
       
        // 'attatchments',
    ];

    public function Courses()
{
    return $this->belongsTo(Courses::class, 'course_id');
}

public function ActivityFilesDoc(){
    return $this -> hasMany(ActivityFilesDoc::class,  'activity_id', 'id');
}

public function ActivityFilesImages(){
    return $this -> hasMany(ActivityFilesImages::class,  'activity_id', 'id');
}

public function ActivityFilesVideos(){
    return $this -> hasMany(ActivityFilesVideos::class,  'activity_id', 'id');
}

public function activityStates()
{
    return $this->hasMany(ActivityState::class, 'activity_id', 'id');
}

}
