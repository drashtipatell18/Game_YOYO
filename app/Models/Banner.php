<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'image',
        'title',
        'subtitle',
        'link',
    ];

    // You can add any additional methods or relationships here if needed
}
