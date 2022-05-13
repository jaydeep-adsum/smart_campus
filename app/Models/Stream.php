<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stream extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    public $table = 'streams';

    /**
     * @var string[]
     */
    public $fillable = [
        'name'
    ];
}
