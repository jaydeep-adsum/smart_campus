<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    public $table = 'interviews';

    /**
     * @var string[]
     */
    public $fillable = [
        'question',
        'answer',
    ];
}
