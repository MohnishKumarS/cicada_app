<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Brands extends Model
{
  
    public function categories(){
        return $this->hasMany(Category::class,'brand_id');
    }
    public function product(){
        return $this->hasMany(Product::class, 'brand_id');
    }
    protected $fillable = [
        'brand_name',
        'brand_icon',
        'brand_image',
        'brand_status',
    ];
    use HasFactory;

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value ?: $this->brand_name);
    }

   

}
