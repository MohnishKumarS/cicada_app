<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Category extends Model
{
    public function brand(){
        return $this->belongsTo(Brands::class,'brand_id'); 
    }

    public function product(){
        return  $this->hasMany(Product::class);
    }

    use HasFactory;
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value ?: $this->category_name);
    }
}
