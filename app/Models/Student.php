<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Student extends Authenticatable implements HasMedia
{
    use HasApiTokens, Notifiable, InteractsWithMedia;

    const PATH = 'student';
    protected $appends = ['image_url'];
    public $table = 'students';
    public $fillable = [
        'first_name',
        'father_name',
        'last_name',
        'email',
        'password',
        'institute_name',
        'department',
        'semester',
        'dob',
        'gender',
        'student_id',
        'year',
        'mobile_no',
        'emergency_contact',
        'address',
        'city',
        'state',
        'is_active',
        'device_token',
        'device_type',
    ];
    protected $hidden = [
        'password'
    ];
    protected $guard = 'students';

    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(Student::PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('public/assets/images/no-student.png');
    }
}
