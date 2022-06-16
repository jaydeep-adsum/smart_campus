<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Category extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * @var string
     */
    public $table = 'categories';

    const PATH = 'category_image';
    /**
     * @var string[]
     */
    public $fillable = [
        'name','institute_id',
    ];

    protected $appends = ['image_url'];

    public static $rules = [
        'name' => 'required',
        'image' => 'required',
    ];

    /**
     * @return HasMany
     */
    public function cafeteria()
    {
        return $this->hasMany(Cafeteria::class);
    }

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
