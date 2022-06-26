<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Year extends Model
{
    use HasFactory;

    public $table = 'years';

    public $fillable = [
        'year','institute_id',
    ];
    protected $with = ['institute'];

    public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }
}
