<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fellowship extends Model
{
    use HasFactory;

    public $table = 'fellowships';

    public $fillable = [
        'name',
        'start_date',
        'end_date',
        'description',
        'web_url',
        'institute_id',
    ];

    public static $rules = [
        'name' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'description' => 'required',
        'web_url' => 'required',
    ];
}
