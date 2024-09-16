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

    ];
    
    public function Activities(){
        return $this -> hasMany(Activities::class);
    }
    public function Handouts(){
        return $this -> hasMany(Handouts::class);
    }


}
