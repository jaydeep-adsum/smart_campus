<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Note extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    /**
     * @var string
     */
    public $table = 'notes';

    const PATH = 'note_image';
    const PDF_PATH = 'note_pdf';

    /**
     * @var string[]
     */
    protected $appends = ['image_url', 'pdf_url'];

    /**
     * @var string[]
     */
    public $fillable = [
        'title',
        'chapter',
        'description',
//        'year_id',
//        'department_id',
        'institute_id',
    ];

    /**
     * @var string[]
     */
    public static $rules = [
        'title' => 'required',
        'chapter' => 'required',
        'description' => 'required',
//        'year_id' => 'required',
//        'department_id' => 'required',
    ];

//    public function department()
//    {
//        return $this->belongsTo(Department::class, 'department_id');
//    }
//
//    public function year()
//    {
//        return $this->belongsTo(Year::class, 'year_id');
//    }

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
     * @return string|void
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
