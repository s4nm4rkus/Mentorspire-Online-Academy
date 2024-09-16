<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentHandouts extends Model
{
    use HasFactory;
    protected $table = 'handout_documents_tbl';
    protected $fillable = [
        'handout_file_title',
        'handout_file_name',
        'handout_doc',
        'course_id',
    ];

    public function Courses()
    {
        return $this->belongsTo(Courses::class, 'course_id');
    }
}
