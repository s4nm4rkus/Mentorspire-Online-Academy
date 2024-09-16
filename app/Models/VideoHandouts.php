<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoHandouts extends Model
{
    use HasFactory;
    protected $table = 'handout_videos_tbl';
    protected $fillable = [
        'handout_video_title',
        'handout_video',
        'course_id',
    ];

    public function Courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
