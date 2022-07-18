<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CafeteriaUser extends Model
{
    use HasFactory;
    public $table = 'cafeteria_users';
    protected $with = ['user','institute'];

    public $fillable = [
        'user_id',
        'institute_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function institute(){
        return $this->belongsTo(Institute::class);
    }
}
