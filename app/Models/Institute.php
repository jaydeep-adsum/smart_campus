<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Institute extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const PATH = 'institute_image';

    public $table = 'institutes';

    public $fillable = [
        'institute','user_id','address','contact',
    ];

    protected $appends = ['image_url'];

    /**
     * @return string
     */
    public function getImageUrlAttribute(): string
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }

        return asset('public/assets/images/no-image.png');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
