<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityFilesDoc extends Model
{
    use HasFactory;

    protected $table = 'activityfilesdoc_tbl';
    protected $fillable = [
        'activity_doc',
        // 'activity_image',
        // 'activity_video',
        'activity_doc_name',
        // 'activity_image_name',
        // 'activity_video_name',
        'activity_id',
       
        // 'attatchments',
    ];

    public function Activities()
    {
        return $this->belongsTo(Activities::class, 'activity_id');
    }
}
