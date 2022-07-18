<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class TextBook extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    const PATH = 'text_book_image';
    const PDF_PATH = 'text_book_pdf';

    /**
     * @var string[]
     */
    public static $rules = [
        'title' => 'required',
        'written_by' => 'required',
        'description' => 'required',
        'department_id' => 'required',
    ];

    /**
     * @var string
     */
    public $table = 'text_books';

    /**
     * @var string[]
     */
    protected $appends = ['image_url', 'pdf_url'];

    /**
     * @var string[]
     */
    protected $with = ['department'];

    /**
     * @var string[]
     */
    public $fillable = [
        'title',
        'written_by',
        'description',
        'department_id',
        'institute_id',
    ];

    /**
     * @return BelongsTo
     */
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
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

    /**
     * @return string
     */
    public function getPdfUrlAttribute()
    {
        /** @var Media $media */
        $media = $this->getMedia(self::PDF_PATH)->first();
        if (!empty($media)) {
            return $media->getFullUrl();
        }
    }
}
