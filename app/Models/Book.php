<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'name_book', 'name_author', 'descrption', 'quantity', 'price', 'tax', 'featured_image', 'active', 'number_of_pages', 'category_id'
    ];
    public function scopeSearch($query,$term)
    {
        $term = "%$term%";
        $query->where(function($query) use ($term){
            $query->where('name_book','like',$term);
        }); 
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

  
}
