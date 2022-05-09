<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    public $table = 'categories';

    /**
     * @var string[]
     */
    public $fillable = [
        'name'
    ];

    /**
     * @var string[]
     */

    /**
     * @return HasMany
     */
    public function cafeteria()
    {
        return $this->hasMany(Cafeteria::class);
    }
}
