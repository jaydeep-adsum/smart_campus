<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Note extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $table = 'notes';
    const PATH = 'note_image';
    const PDF_PATH = 'note_pdf';
    protected $appends = ['image_url', 'pdf_url'];
    public $fillable = [
        'title',
        'chapter',
        'description',
        'year',
        'stream',
    ];

    public static $rules = [
        'title' => 'required',
        'chapter' => 'required',
        'description' => 'required',
        'year' => 'required',
        'stream' => 'required',
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

    public function getPdfUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PDF_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }
    }
}
