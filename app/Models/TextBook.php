<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TextBook extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const PATH = 'text_book_image';
    const PDF_PATH = 'text_book_pdf';
    public static $rules = [
        'title' => 'required',
        'written_by' => 'required',
        'description' => 'required',
        'year' => 'required',
        'stream' => 'required',
    ];
    public $table = 'text_books';
    public $fillable = [
        'title',
        'written_by',
        'description',
        'year',
        'stream',
    ];
    protected $appends = ['image_url', 'pdf_url'];

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
