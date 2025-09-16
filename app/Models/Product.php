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
        'windows_version',
        'windows_processor',
        'windows_memory',
        'windows_graphics',
        'windows_storage',
        'image',
        'description',
        'weight',
        'dimensions',
        'status',
        'release_date',
        'platform',
  // Android
        'android_price',
        'android_version',
  // iOS     
        'ios_price',
        'ios_version',
        'file_url'
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
