<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageHandouts extends Model
{
    use HasFactory;
    protected $table = 'handout_images_tbl';
    protected $fillable = [
        'handout_image_title',
        'handout_image_name',
        'handout_image',
        'course_id',
    ];

    public function Courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
