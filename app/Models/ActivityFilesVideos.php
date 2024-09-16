<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityFilesVideos extends Model
{
    use HasFactory;
    protected $table = 'activityfiles_videos_tbl';
    protected $fillable = [
        'activity_video',
        'activity_video_name',
        'activity_id',
    ];

    public function Activities()
    {
        return $this->belongsTo(Activities::class, 'activity_id');
    }
}
