<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "products";
    protected $fillable = [
        'category_id',
        'SKU',
        'tags',
        'name',
        'price',
        'image',
        'description',
        'weight',
        'dimensions',
        'status',
        'release_date',
        'platform',
        'android_price',
        'ios_price',

    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class);
    }
}
