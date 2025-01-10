<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{

    public function brand(){
        return $this->belongsTo(Brands::class,'brand_id'); 
    }
    public function category(){
        return $this->belongsTo(Category::class); 
    }
    protected $fillable = [
        'product_name',
        'slug',
        'product_description',
        'size',
        'quantity',
        'actual_price',
        'offer_price',
        'brand_id',
        'category_id',
        'main_img',
        'additional_images',
        'stock',
        'trending',
        'status',
    ];
    
    use HasFactory;
    
 

    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value ?: $this->product_name);
    }



}
