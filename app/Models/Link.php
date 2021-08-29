<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    public const MAX_LEN = 12;
    public const SYMBOLS_COUNT = 40;

    public $timestamps = false;

    protected $fillable = [
        'link', 'short_link'
    ];
}
