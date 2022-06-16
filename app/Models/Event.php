<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const PATH = 'event';
    public $table = 'events';
    public $fillable = [
        'title',
        'date',
        'location',
        'detail',
        'from',
        'to',
        'registration_link',
        'created_by',
        'institute_id',
    ];
    protected $appends = ['image_url'];

    public static $rules = [
        'title' => 'required',
        'date' => 'required',
        'location' => 'required',
        'detail' => 'required',
        'from' => 'required',
        'to' => 'required',
    ];

    public function getImageUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('public/assets/images/no-image.png');
    }
}
