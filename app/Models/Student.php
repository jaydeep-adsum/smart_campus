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

    /**
     * @var string[]
     */
    protected $appends = ['image_url'];

    /**
     * @var string
     */
    public $table = 'students';

    /**
     * @var string[]
     */
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
    /**
     * @var string[]
     */
    protected $hidden = [
        'password'
    ];
    /**
     * @var string[]
     */
    public static $rules = [
        'first_name' => 'required',
        'father_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:students,email',
        'institute_name' => 'required',
        'department' => 'required',
        'semester' => 'required',
        'dob' => 'required|date',
        'gender' => 'required',
        'student_id' => 'required',
        'year' => 'required',
        'mobile_no' => 'required|numeric|digits:10',
        'emergency_contact' => 'required|numeric|digits:10',
        'address' => 'required',
        'city' => 'required',
        'state' => 'required',
    ];

    /**
     * @var string
     */
    protected $guard = 'students';

    /**
     * @return string
     */
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
