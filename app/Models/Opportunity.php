<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Opportunity extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * @var string
     */
    public $table = 'opportunities';

    const PATH = 'opportunity_image';
    protected $appends = ['image_url'];
    /**
     * @var string[]
     */
    public $fillable = [
        'company_name',
        'interview_date',
        'location',
        'criteria',
        'overview',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'company_name' => 'required',
        'interview_date' => 'required',
        'location' => 'required',
        'criteria' => 'required',
        'overview' => 'required|url',
        'image' => 'required',
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
