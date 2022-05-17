<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    public $table = 'departments';

    /**
     * @var string[]
     */
    public $fillable = [
      'department',
    ];
}