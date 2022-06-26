<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    public $table = 'attendances';

    public $fillable = [
        'student_id','dates','month','year',
    ];

    public function student(){
            return $this->belongsTo(Student::class, 'student_id');
    }
}
