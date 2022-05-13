<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Cafeteria extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const PATH = 'cafeteria_image';
    public $table = 'cafeterias';
    public $fillable = [
        'name',
        'price',
        'category_id',
    ];
    protected $appends = ['image_url'];
    protected $with = ['category'];

    public static $rules = [
        'name' => 'required',
        'price' => 'required',
        'category_id' => 'required',
        'image' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return string
     */
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
